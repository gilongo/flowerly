import { Component, OnInit } from '@angular/core';
import { RouterLink } from '@angular/router';
import { MatButtonModule } from '@angular/material/button';
import { MatFormFieldModule } from '@angular/material/form-field';
import { MatInputModule } from '@angular/material/input';
import { FormsModule, FormControl } from '@angular/forms';
import { CustomerService, Customer } from '../customer.service';
import { ProductsService, Product } from '../products.service';
import { MatSelectModule } from '@angular/material/select';
import { NgForOf } from '@angular/common';

@Component({
  selector: 'app-create-order',
  standalone: true,
  imports: [RouterLink, MatButtonModule, MatFormFieldModule, MatInputModule, FormsModule, MatSelectModule, NgForOf],
  templateUrl: './create-order.component.html',
  styleUrl: './create-order.component.css'
})
export class CreateOrderComponent implements OnInit {

  customers: Customer[] = [];
  products: Product[] = [];

  description = new FormControl('', { nonNullable: true });

  selectedProduct: Product | undefined;
  selectedCustomer: Customer | undefined;
  selectedQuantity: number | undefined;

  selectedProducts: Product[] = [];

  newOrder = {
    customerId: '',
    description: '',
    products: [],
    totalPrice: 0
  }

  constructor(private customerService: CustomerService, private productsService: ProductsService) {}

  ngOnInit(): void {
    this.customerService.getCustomers().subscribe(customers => {
      this.customers = customers.data.customers
      console.log(this.customers)
    })

    this.productsService.getProducts().subscribe(products => {
      this.products = products.data.products
      console.log(this.selectedProducts)
    })
  }

  // TODO: refactor this
  addProduct() {
    if (this.selectedProduct && this.selectedQuantity) {
      this.selectedProducts.push(this.selectedProduct)
      this.newOrder.totalPrice = this.newOrder.totalPrice + this.selectedProduct.price * this.selectedQuantity

      console.log(this.newOrder)
    }
  }
}
