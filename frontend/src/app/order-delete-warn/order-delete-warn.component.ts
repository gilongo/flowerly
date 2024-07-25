import { Component, inject } from '@angular/core';
import { OrdersService, Order } from '../orders.service';
import { CustomCurrencyPipe } from '../utils/custom-currency.pipe';
import { DatePipe } from '@angular/common';
import { MatDialogRef, MAT_DIALOG_DATA, MatDialogActions,MatDialogClose,} from '@angular/material/dialog';
import { MatButtonModule } from '@angular/material/button';
import { CommonModule } from '@angular/common';
import { MatProgressSpinnerModule } from '@angular/material/progress-spinner';

@Component({
  selector: 'app-order-delete-warn',
  standalone: true,
  imports: [CustomCurrencyPipe, DatePipe, CommonModule, MatButtonModule, MatDialogActions, MatDialogClose, MatProgressSpinnerModule],
  templateUrl: './order-delete-warn.component.html',
  styleUrl: './order-delete-warn.component.css'
})
export class OrderDeleteWarnComponent {
  readonly data = inject<Order>(MAT_DIALOG_DATA);
  
  loading = false;

  constructor(private ordersService: OrdersService, public dialogRef: MatDialogRef<OrderDeleteWarnComponent>) {}

  confirmDelete(): void {
    this.ordersService.deleteOrder(this.data.id).subscribe(() => {
      this.dialogRef.close(true);
    })
  }

  onClose(): void {
    this.dialogRef.close(false);
  }
}
