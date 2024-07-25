import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

export interface ProductsResponseData {
  data: ProductsData
}

export interface ProductsData {
  count: number
  products: Product[]
}

export interface Product {
  id: string
  name: string
  price: number
}


@Injectable({
  providedIn: 'root'
})
export class ProductsService {

  private productsUrl = 'http://localhost:9000/api/products';

  constructor(private http: HttpClient) { }

  getProducts(): Observable<ProductsResponseData> {
    return this.http.get<ProductsResponseData>(this.productsUrl);
  }
}
