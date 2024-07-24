import { ComponentFixture, TestBed } from '@angular/core/testing';

import { CliccableIconComponent } from './cliccable-icon.component';

describe('CliccableIconComponent', () => {
  let component: CliccableIconComponent;
  let fixture: ComponentFixture<CliccableIconComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [CliccableIconComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(CliccableIconComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
