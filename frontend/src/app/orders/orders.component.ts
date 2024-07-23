import { Component, CUSTOM_ELEMENTS_SCHEMA, OnInit } from '@angular/core';
import { FormControl, ReactiveFormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';
import { ClarityModule } from '@clr/angular';
import { OrdersService, Order } from '../orders.service';

@Component({
  selector: 'app-orders',
  standalone: true,
  imports: [CommonModule, ReactiveFormsModule, ClarityModule],
  templateUrl: './orders.component.html',
  styleUrls: ['./orders.component.css'],
  schemas: [CUSTOM_ELEMENTS_SCHEMA],
})

export class OrdersComponent implements OnInit {

  orders: Order[] =  [] ;

  constructor(private ordersService: OrdersService) { }

  ngOnInit(): void {
    this.ordersService.getOrders().subscribe(orders => {
      this.orders = orders.data.orders
    })
  }
}