import { Component, OnInit } from '@angular/core';
import { RouterLink } from '@angular/router';
import { MatButtonModule } from '@angular/material/button';
import { MatFormFieldModule } from '@angular/material/form-field';
import { MatInputModule } from '@angular/material/input';
import { FormsModule } from '@angular/forms';
import { CustomerService, Customer } from '../customer.service';
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
  selectedCustomer: Customer | undefined;

  description = '';

  constructor(private customerService: CustomerService) {}

  ngOnInit(): void {
    this.customerService.getCustomers().subscribe(customers => {
      this.customers = customers.data.customers
      console.log(this.customers)
    })
  }
}
