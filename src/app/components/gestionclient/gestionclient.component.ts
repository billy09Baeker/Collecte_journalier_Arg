import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterModule } from '@angular/router';

interface Client {
  id: number;
  nom: string;
  prenom: string;
  sexe: string;
  email: string;
  telephone: string;
  solde: number;
}

@Component({
  selector: 'app-gestionclient',
  standalone: true,
  imports: [CommonModule, RouterModule],
  templateUrl: './gestionclient.component.html',
  styleUrl: './gestionclient.component.scss'
})
export class GestionclientComponent {
  clients: Client[] = [
    {
      id: 1,
      nom: 'Jane',
      prenom: 'Doe',
      sexe: 'Femme',
      email: 'jane.doe@example.com',
      telephone: '098765321',
      solde: 0
    },
    {
      id: 2,
      nom: 'Loulou',
      prenom: 'Kikou',
      sexe: 'Feminin',
      email: 'lilou@gmail.fr',
      telephone: '699458752',
      solde: 0
    },
    {
      id: 3,
      nom: 'Pelagie',
      prenom: 'Kouta',
      sexe: 'Feminin',
      email: 'kouta@gmail.fr',
      telephone: '654123698',
      solde: 0
    }
  ];

  viewDetails(clientId: number): void {
    // Navigate to client details page
    console.log(`Viewing details for client ID: ${clientId}`);
    // This would typically use Angular Router to navigate:
    // this.router.navigate(['/clients', clientId]);
  }

  deleteClient(clientId: number): void {
    // Delete client from the array
    this.clients = this.clients.filter(client => client.id !== clientId);
    console.log(`Client with ID: ${clientId} has been deleted`);
  }
}