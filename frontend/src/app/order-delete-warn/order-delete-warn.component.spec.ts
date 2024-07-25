import { ComponentFixture, TestBed } from '@angular/core/testing';

import { OrderDeleteWarnComponent } from './order-delete-warn.component';

describe('OrderDeleteWarnComponent', () => {
  let component: OrderDeleteWarnComponent;
  let fixture: ComponentFixture<OrderDeleteWarnComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [OrderDeleteWarnComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(OrderDeleteWarnComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
