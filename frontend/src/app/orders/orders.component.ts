import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { MatTableDataSource, MatTableModule } from '@angular/material/table';
import { OrdersService, Order } from '../orders.service';
import { CustomCurrencyPipe } from '../utils/custom-currency.pipe';
import {MatIconModule} from '@angular/material/icon';
import { CliccableIconComponent } from '../cliccable-icon/cliccable-icon.component';

@Component({
  selector: 'app-orders',
  standalone: true,
  imports: [CommonModule, MatTableModule, CustomCurrencyPipe, MatIconModule, CliccableIconComponent],
  templateUrl: './orders.component.html',
  styleUrls: ['./orders.component.css'],
  schemas: [],
})

export class OrdersComponent implements OnInit {

  orders: Order[] =  [] ;
  dataSource = new MatTableDataSource<Order>(this.orders)

  constructor(private ordersService: OrdersService) { }

  displayedColumns: string[] = ['id', 'customerId', 'description', 'totalPrice', 'createdAt', 'actions'];

  ngOnInit(): void {
    this.ordersService.getOrders().subscribe(orders => {
      this.orders = orders.data.orders

      this.dataSource = new MatTableDataSource<Order>(this.orders)
    })
  }


}