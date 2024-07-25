import { Component, OnInit, ViewChild } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormControl, FormsModule, ReactiveFormsModule } from '@angular/forms';
import { MatTableDataSource, MatTableModule } from '@angular/material/table';
import { OrdersService, Order } from '../orders.service';
import { CustomCurrencyPipe } from '../utils/custom-currency.pipe';
import { MatIconModule } from '@angular/material/icon';
import { CliccableIconComponent } from '../cliccable-icon/cliccable-icon.component';
import { MatFormFieldModule } from '@angular/material/form-field';
import { MatInputModule } from '@angular/material/input';
import { MatPaginatorModule } from '@angular/material/paginator';
import { MatPaginator } from '@angular/material/paginator';
import { MatDatepickerModule } from '@angular/material/datepicker';
import { MatNativeDateModule } from '@angular/material/core';
import { MatButtonModule } from '@angular/material/button';
import { RouterLink} from '@angular/router';
import { SpinnerComponent } from "../utils/spinner.component";
import { CustomerService } from '../customer.service';
import { MatDialog, MatDialogModule } from '@angular/material/dialog';
import { CustomerDetailComponent } from '../customer-detail/customer-detail.component';

@Component({
  selector: 'app-orders',
  standalone: true,
  imports: [CommonModule, MatTableModule, MatPaginatorModule, CustomCurrencyPipe, MatIconModule, CliccableIconComponent, MatFormFieldModule, MatInputModule, FormsModule, MatDatepickerModule, MatNativeDateModule, ReactiveFormsModule, MatButtonModule, RouterLink, SpinnerComponent, MatDialogModule, CustomerDetailComponent],
  templateUrl: './orders.component.html',
  styleUrls: ['./orders.component.css'],
  schemas: [],
})

export class OrdersComponent implements OnInit {

  orders: Order[] = [] ;
  filteredOrders: Order[] = [];
  searchText = '';
  dataSource: MatTableDataSource<Order>;

  startDate = new FormControl();
  endDate = new FormControl();

  @ViewChild(MatPaginator)
  paginator!: MatPaginator;

  constructor(private ordersService: OrdersService, private customerService: CustomerService, public dialog: MatDialog) {
    this.dataSource = new MatTableDataSource<Order>();
  }

  displayedColumns: string[] = ['id', 'customerId', 'description', 'totalPrice', 'createdAt', 'edit', 'delete'];

  ngOnInit(): void {
    this.ordersService.getOrders().subscribe(orders => {
      this.orders = orders.data.orders
      this.filteredOrders = orders.data.orders
      this.dataSource.data = orders.data.orders

      this.dataSource.paginator = this.paginator;
    })
  }

  applyFilter(event: Event): void {
    const filterValue = (event.target as HTMLInputElement).value;
    this.dataSource.filter = filterValue.trim().toLowerCase();
  }

  applyDateFilter(): void {
    const start = this.startDate.value;
    const end = this.endDate.value;

    if (start) {
      this.dataSource.data = this.orders.filter(order => {
        const orderDate = new Date(order.createdAt);
        return orderDate >= start;
      });
    }

    if (end) {
      this.dataSource.data = this.orders.filter(order => {
        const orderDate = new Date(order.createdAt);
        return orderDate <= end;
      });
    }

    if (!start && !end) {
        this.dataSource.data = this.orders;
    }
  }

  clearFilters(): void {
    this.searchText = '';
    this.dataSource.filter = '';
    this.dataSource.data = this.orders;
    this.startDate.reset();
    this.endDate.reset();
  }

  customerDetail(id: any, event: Event) {

    this.customerService.getCustomerById(id).subscribe(customer => {
      const dialogRef = this.dialog.open(CustomerDetailComponent, {
        data: customer
      });
    })
  }

  editOrder(data: any, event: Event) {
    console.log(data, event);
  }

}
