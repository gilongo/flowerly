import { Routes } from '@angular/router';
import { OrdersComponent } from './orders/orders.component';
import { EditOrderComponent } from './edit-order/edit-order.component';

export const routes: Routes = [
    { path: 'orders', component: OrdersComponent },
    { path: '', redirectTo: 'orders', pathMatch: 'full' },
    { path: 'orders/edit', component: EditOrderComponent },
];
