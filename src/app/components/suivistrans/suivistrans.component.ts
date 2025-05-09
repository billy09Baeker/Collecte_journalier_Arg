import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FontAwesomeModule } from '@fortawesome/angular-fontawesome';
import { faTrash } from '@fortawesome/free-solid-svg-icons';

interface Transaction {
  id: number;
  date: string;
  montant: number;
  beneficiaire: string;
  reference: string;
  statut: string;
  complete: boolean;
}

@Component({
  selector: 'app-suivistrans',
  standalone: true,
  imports: [CommonModule, FontAwesomeModule],
  templateUrl: './suivistrans.component.html',
  styleUrl: './suivistrans.component.scss'
})
export class SuivistransComponent implements OnInit {
  // Icône pour le bouton supprimer
  faTrash = faTrash;
  
  // Liste des transactions
  transactions: Transaction[] = [];

  ngOnInit(): void {
    // Initialisation des données de transaction
    this.genererTransactions();
  }

  // Méthode pour générer des données de transaction fictives
  genererTransactions(): void {
    this.transactions = [
      { 
        id: 1, 
        date: '2025-05-07', 
        montant: 1500.00, 
        beneficiaire: 'Entreprise ABC', 
        reference: 'TR-2025-001', 
        statut: 'Validée', 
        complete: true 
      },
      { 
        id: 2, 
        date: '2025-05-08', 
        montant: 750.50, 
        beneficiaire: 'Fournisseur XYZ', 
        reference: 'TR-2025-002', 
        statut: 'En cours', 
        complete: false 
      },
      { 
        id: 3, 
        date: '2025-05-08', 
        montant: 2300.75, 
        beneficiaire: 'Services Tech', 
        reference: 'TR-2025-003', 
        statut: 'En attente', 
        complete: false 
      },
      { 
        id: 4, 
        date: '2025-05-06', 
        montant: 475.25, 
        beneficiaire: 'Consultant Martin', 
        reference: 'TR-2025-004', 
        statut: 'Validée', 
        complete: true 
      },
      { 
        id: 5, 
        date: '2025-05-05', 
        montant: 1800.00, 
        beneficiaire: 'Maintenance Info', 
        reference: 'TR-2025-005', 
        statut: 'Refusée', 
        complete: true 
      }
    ];
  }

  // Méthode pour supprimer une transaction
  supprimerTransaction(id: number): void {
    if (confirm('Êtes-vous sûr de vouloir supprimer cette transaction?')) {
      this.transactions = this.transactions.filter(transaction => transaction.id !== id);
      console.log(`Transaction ${id} supprimée avec succès`);
    }
  }

  // Méthode pour obtenir la classe CSS selon le statut de la transaction
  getStatutClass(statut: string): string {
    switch (statut) {
      case 'Validée':
        return 'statut-valide';
      case 'En cours':
        return 'statut-en-cours';
      case 'En attente':
        return 'statut-en-attente';
      case 'Refusée':
        return 'statut-refuse';
      default:
        return '';
    }
  }
}