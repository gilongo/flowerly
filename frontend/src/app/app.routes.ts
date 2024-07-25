import { Routes } from '@angular/router';
import { OrdersComponent } from './orders/orders.component';
import {CreateOrderComponent} from "./create-order/create-order.component";

export const routes: Routes = [
    { path: 'orders', component: OrdersComponent },
    { path: '', redirectTo: 'orders', pathMatch: 'full' },
    { path: 'create-order', component: CreateOrderComponent },
];
