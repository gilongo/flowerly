import { Component } from '@angular/core';
import {MatProgressSpinnerModule} from '@angular/material/progress-spinner';

@Component({
  selector: 'spinner',
  template: '<mat-spinner></mat-spinner>',
  standalone: true,
  imports: [MatProgressSpinnerModule],
})

export class SpinnerComponent {}
