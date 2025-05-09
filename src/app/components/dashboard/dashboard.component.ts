import { Component, OnInit } from '@angular/core';
import { RouterLink } from '@angular/router';

@Component({
  selector: 'app-dashboard',
  imports: [RouterLink],
  templateUrl: './dashboard.component.html',
  styleUrl: './dashboard.component.scss'
})
export class DashboardComponent  implements OnInit {
  ngOnInit(): void {
    throw new Error('Method not implemented.');
  }
  
  collecteursCount = 0;
  clientsCount = 0;

  onManageCollectors(): void {}
  onManageClients(): void {}
  onFollowTransactions(): void {}
  onAnalyzePerformance(): void {}
}
