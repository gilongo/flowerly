import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

interface ProductDetail {
  id: string;
  name: string;
  price: number;
}

interface Product {
  product: ProductDetail;
  quantity: number;
}

export interface Order {
  id: string;
  customerId: string;
  description: string;
  products: Product[];
  totalPrice: number;
  createdAt: Date;
}

export interface Orders {
  orders: Order[]
}

export interface OrdersData {
  data: Orders
}

@Injectable({
  providedIn: 'root'
})

export class OrdersService {

  private ordersUrl = 'http://localhost:9000/api/orders';

  constructor(private http: HttpClient) { }

  getOrders(): Observable<OrdersData> {
    return this.http.get<OrdersData>(this.ordersUrl);
  }
}
