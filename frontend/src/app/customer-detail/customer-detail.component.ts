import { Component,inject } from '@angular/core';
import { MatDialogRef, MAT_DIALOG_DATA} from '@angular/material/dialog';
import { MatButtonModule } from '@angular/material/button';
import { CommonModule } from '@angular/common';
import { Customer } from '../customer.service';

@Component({
  selector: 'app-customer-detail',
  standalone: true,
  imports: [MatButtonModule, CommonModule],
  templateUrl: './customer-detail.component.html',
  styleUrl: './customer-detail.component.css'
})
export class CustomerDetailComponent {
  constructor(public dialogRef: MatDialogRef<CustomerDetailComponent>) {}

  readonly data = inject<Customer>(MAT_DIALOG_DATA);

  onClose(): void {
    this.dialogRef.close();
  }
}
