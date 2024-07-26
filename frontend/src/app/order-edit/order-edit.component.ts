import { Component, inject } from '@angular/core';
import { OrdersService, Order, OrderUpdateData, ProductUpdate } from '../orders.service';
import { CustomCurrencyPipe } from '../utils/custom-currency.pipe';
import { DatePipe } from '@angular/common';
import { MatDialogRef, MAT_DIALOG_DATA, MatDialogActions, MatDialogClose} from '@angular/material/dialog';
import { MatButtonModule } from '@angular/material/button';
import { CommonModule } from '@angular/common';
import { MatProgressSpinnerModule } from '@angular/material/progress-spinner';
import { FormsModule } from '@angular/forms';
import { MatFormFieldModule } from '@angular/material/form-field';
import { MatInputModule } from '@angular/material/input';

@Component({
  selector: 'app-order-edit',
  standalone: true,
  imports: [CustomCurrencyPipe, DatePipe, CommonModule, MatButtonModule, MatDialogActions, MatDialogClose, MatProgressSpinnerModule, FormsModule, MatFormFieldModule, MatInputModule],
  templateUrl: './order-edit.component.html',
  styleUrl: './order-edit.component.css'
})
export class OrderEditComponent {
  readonly data = inject<Order>(MAT_DIALOG_DATA);
  
  loading = false;

  constructor(private ordersService: OrdersService, public dialogRef: MatDialogRef<OrderEditComponent>) {}

  confirmUpdate(): void {
    let productsUpdate = this.data.products.map((products) => {
      return { id: products.product.id, quantity: products.quantity } as ProductUpdate
    })

    let orderUpdate: OrderUpdateData = {
      customer_id: this.data.customerId,
      description: this.data.description,
      products: productsUpdate
    }

    this.ordersService.updateOrder(this.data.id, orderUpdate).subscribe((result) =>{
      this.dialogRef.close({ updated: true, data: this.data});
    });
  }

  onClose(): void {
    this.dialogRef.close(false);
  }
}
