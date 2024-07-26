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

export interface ProductUpdate {
  id: string;
  quantity: number;
}

export interface OrderUpdateData {
  customer_id: string;
  description: string;
  products: ProductUpdate[];
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

  createOrder(order: OrderUpdateData): Observable<Order> {
    return this.http.post<Order>(this.ordersUrl, order);
  }

  updateOrder(id: string, order: OrderUpdateData): Observable<any> {
    return this.http.patch<void>(this.ordersUrl + `/${id}`, order);
  }

  deleteOrder(id: string): Observable<any> {
    return this.http.delete<void>(this.ordersUrl + `/${id}`);
  }
}
