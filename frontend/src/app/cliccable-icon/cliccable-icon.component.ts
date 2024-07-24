import { Component, Input } from '@angular/core';
import { MatIconModule } from '@angular/material/icon';

@Component({
  selector: 'app-cliccable-icon',
  standalone: true,
  imports: [MatIconModule],
  templateUrl: './cliccable-icon.component.html',
  styleUrl: './cliccable-icon.component.css'
})
export class CliccableIconComponent {

  @Input() iconType: string = '';

  onIconClick() {
    alert('Cliccato');
  }
}
