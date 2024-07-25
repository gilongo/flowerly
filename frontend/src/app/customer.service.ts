import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

export interface Customer {
  id: string
  firstName: string
  lastName: string
  address: string
  email: string
  phone: string
}

export interface Customers {
  customers: Customer[]
}

export interface CustomersData {
  data: Customers
}

@Injectable({
  providedIn: 'root'
})


export class CustomerService {

  private customersUrl = 'http://localhost:9000/api/customers';

  constructor(private http: HttpClient) { }

  getCustomers(): Observable<CustomersData> {
    return this.http.get<CustomersData>(this.customersUrl);
  }

  getCustomerById(id: string): Observable<Customer> {
    return this.http.get<Customer>(this.customersUrl+`/${id}`);
  }
}
