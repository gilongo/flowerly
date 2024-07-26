import { Component, OnInit } from '@angular/core';
import { RouterLink } from '@angular/router';
import { MatButtonModule } from '@angular/material/button';
import { MatFormFieldModule } from '@angular/material/form-field';
import { MatInputModule } from '@angular/material/input';
import { FormsModule, FormControl } from '@angular/forms';
import { CustomerService, Customer } from '../customer.service';
import { ProductsService, Product } from '../products.service';
import { OrdersService, OrderUpdateData } from '../orders.service';
import { MatSelectModule } from '@angular/material/select';
import { CommonModule } from '@angular/common';
import { MatDividerModule } from '@angular/material/divider';
import { CustomCurrencyPipe } from '../utils/custom-currency.pipe';
import { MatTableDataSource, MatTableModule } from '@angular/material/table';
import { MatIconModule } from '@angular/material/icon';
import { MatProgressSpinnerModule } from '@angular/material/progress-spinner';
import { MatSnackBar } from '@angular/material/snack-bar';
import { Router } from '@angular/router';

interface newOrder {
  customerId: string,
  description: string,
  products: Product[],
  totalPrice: number
}

@Component({
  selector: 'app-create-order',
  standalone: true,
  imports: [RouterLink, MatButtonModule, MatFormFieldModule, MatInputModule, FormsModule, MatSelectModule, MatDividerModule, CustomCurrencyPipe, MatTableModule, MatIconModule, MatProgressSpinnerModule, CommonModule],
  templateUrl: './create-order.component.html',
  styleUrl: './create-order.component.css'
})

export class CreateOrderComponent implements OnInit {

  customers: Customer[] = [];
  products: Product[] = [];

  description = '';

  selectedProduct: Product | undefined;
  selectedCustomer: Customer | undefined;
  selectedQuantity: number | undefined;

  selectedProducts: {product: Product, quantity: number}[] = [];

  totalPrice = 0.00;

  newOrder: OrderUpdateData = {
    customer_id: '',
    description: '',
    products: [],
  }

  dataSource = new MatTableDataSource<any>(this.selectedProducts);
  displayedColumns: string[] = ['name', 'price', 'quantity', 'remove'];

  loading = false;

  constructor(private customerService: CustomerService, private productsService: ProductsService, private ordersService: OrdersService, private _snackBar: MatSnackBar, private router: Router) {}

  ngOnInit(): void {
    this.customerService.getCustomers().subscribe(customers => {
      this.customers = customers.data.customers
    })

    this.productsService.getProducts().subscribe(products => {
      this.products = products.data.products
    })
  }

  openSnackBar(message: string, action: string) {
    this._snackBar.open(message, action, {
      duration: 3000,
    });
  }

  addProduct() {
    if (this.selectedProduct && this.selectedQuantity) {

      this.totalPrice += this.selectedProduct.price * this.selectedQuantity

      this.dataSource.data.push({product: this.selectedProduct, quantity: this.selectedQuantity})
      this.dataSource.data = [...this.dataSource.data]
    }
  }

  removeProduct(product: any) {
    this.dataSource.data = this.dataSource.data.filter((item: any) => item.product.id !== product.product.id)
    this.dataSource.data = [...this.dataSource.data]
  }

  createOrder() {
    if(this.selectedCustomer && this.description && this.dataSource.data.length > 0) {
      this.loading = true
      this.newOrder.customer_id = this.selectedCustomer.id
      this.newOrder.description = this.description
      this.newOrder.products = this.dataSource.data.map((product) => {
        return { id: product.product.id, quantity: product.quantity }
      })

      this.ordersService.createOrder(this.newOrder).subscribe(order => {
        this.loading = false
        this.openSnackBar('Order created successfully', 'Close')
        this.router.navigate(['/orders'])
      })
    }
  }
}
