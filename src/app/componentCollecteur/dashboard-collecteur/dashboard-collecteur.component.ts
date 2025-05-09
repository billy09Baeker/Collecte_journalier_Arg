import { CommonModule } from '@angular/common';
import { Component } from '@angular/core';
import { FormControl, FormGroup, FormsModule, ReactiveFormsModule, Validators } from '@angular/forms';
import { RouterModule } from '@angular/router';

interface Collecteur {
  id: number;
  nom: string;
  prenom: string;
  sexe: string;
  email: string;
  telephone: string;
}

interface Client {
  id: number;
  nom: string;
  prenom: string;
  sexe: string;
  email: string;
  telephone: string;
}

interface Payment {
  id: number;
  clientId: number;
  collecteurId: number;
  montant: number;
  dateEcheance: string;
  datePaiement: string;
}

interface CollecteurPerformance {
  id: number;
  nom: string;
  prenom: string;
  montant: number;
  echeances: number;
}

@Component({
  selector: 'app-dashboard-collecteur',
  imports: [CommonModule, RouterModule, FormsModule, ReactiveFormsModule],
  templateUrl: './dashboard-collecteur.component.html',
  styleUrl: './dashboard-collecteur.component.scss'
})
export class DashboardCollecteurComponent {
  collecteurs: Collecteur[] = [
    {
      id: 1,
      nom: 'Deutou',
      prenom: 'Stéphane',
      sexe: 'Masculin',
      email: 'stefen@gmail.com',
      telephone: '09/05/2025'
    },
    {
      id: 2,
      nom: 'Atanga',
      prenom: 'Kikou',
      sexe: 'Féminin',
      email: '1@2.fr',
      telephone: '08/04/2025'
    }
  ];

  clients: Client[] = [
    {
      id: 1,
      nom: 'Kamga',
      prenom: 'Paul',
      sexe: 'Masculin',
      email: 'paul@example.com',
      telephone: '655123456'
    },
    {
      id: 2,
      nom: 'Nkengue',
      prenom: 'Marie',
      sexe: 'Féminin',
      email: 'marie@example.com',
      telephone: '677889900'
    }
  ];

  payments: Payment[] = [
    {
      id: 1,
      clientId: 1,
      collecteurId: 1,
      montant: 50000,
      dateEcheance: '10/5/25',
      datePaiement: '09/05/2025'
    },
    {
      id: 2,
      clientId: 2,
      collecteurId: 2,
      montant: 35000,
      dateEcheance: '10/5/25',
      datePaiement: '08/05/2025'
    }
  ];

  collecteursPerformance: CollecteurPerformance[] = [
    {
      id: 1,
      nom: 'Deutou',
      prenom: 'Stéphane',
      montant: 50000,
      echeances: 1
    },
    {
      id: 2,
      nom: 'Atanga',
      prenom: 'Kikou',
      montant: 35000,
      echeances: 1
    }
  ];

  showAddModal = false;
  showEditModal = false;
  showDeleteModal = false;
  showPaymentModal = false;
  showClientModal = false;
  
  currentCollecteur: Collecteur | null = null;

  collecteurForm = new FormGroup({
    nom: new FormControl('', Validators.required),
    prenom: new FormControl('', Validators.required),
    sexe: new FormControl('', Validators.required),
    email: new FormControl('', [Validators.required, Validators.email]),
    telephone: new FormControl('', Validators.required)
  });

  clientForm = new FormGroup({
    nom: new FormControl('', Validators.required),
    prenom: new FormControl('', Validators.required),
    sexe: new FormControl('', Validators.required),
    email: new FormControl('', [Validators.required, Validators.email]),
    telephone: new FormControl('', Validators.required)
  });

  paymentForm = new FormGroup({
    clientId: new FormControl('', Validators.required),
    collecteurId: new FormControl('', Validators.required),
    montant: new FormControl(50000, Validators.required),
    dateEcheance: new FormControl('10/5/25', Validators.required)
  });

  // Modal functions
  openAddModal(): void {
    this.resetForm();
    this.showAddModal = true;
  }

  openEditModal(collecteur: Collecteur): void {
    this.currentCollecteur = { ...collecteur };
    this.collecteurForm.setValue({
      nom: collecteur.nom,
      prenom: collecteur.prenom,
      sexe: collecteur.sexe,
      email: collecteur.email,
      telephone: collecteur.telephone
    });
    this.showEditModal = true;
  }

  openDeleteModal(collecteur: Collecteur): void {
    this.currentCollecteur = collecteur;
    this.showDeleteModal = true;
  }

  openPaymentModal(): void {
    this.paymentForm.reset({
      montant: 50000,
      dateEcheance: '10/5/25'
    });
    this.showPaymentModal = true;
  }

  openClientModal(): void {
    this.clientForm.reset();
    this.showClientModal = true;
  }

  closeModals(): void {
    this.showAddModal = false;
    this.showEditModal = false;
    this.showDeleteModal = false;
    this.resetForm();
  }

  closePaymentModal(): void {
    this.showPaymentModal = false;
    this.paymentForm.reset();
  }

  closeClientModal(): void {
    this.showClientModal = false;
    this.clientForm.reset();
  }

  resetForm(): void {
    this.collecteurForm.reset();
    this.currentCollecteur = null;
  }

  // CRUD operations
  addCollecteur(): void {
    if (this.collecteurForm.valid) {
      const formValues = this.collecteurForm.value;
      const newCollecteur: Collecteur = {
        id: this.getNextId(),
        nom: formValues.nom || '',
        prenom: formValues.prenom || '',
        sexe: formValues.sexe || '',
        email: formValues.email || '',
        telephone: formValues.telephone || ''
      };
      this.collecteurs.push(newCollecteur);
      this.closeModals();
    }
  }

  updateCollecteur(): void {
    if (this.collecteurForm.valid && this.currentCollecteur) {
      const formValues = this.collecteurForm.value;
      const index = this.collecteurs.findIndex(c => c.id === this.currentCollecteur!.id);
      if (index !== -1) {
        this.collecteurs[index] = {
          id: this.currentCollecteur.id,
          nom: formValues.nom || '',
          prenom: formValues.prenom || '',
          sexe: formValues.sexe || '',
          email: formValues.email || '',
          telephone: formValues.telephone || ''
        };
        this.closeModals();
      }
    }
  }

  deleteCollecteur(): void {
    if (this.currentCollecteur) {
      this.collecteurs = this.collecteurs.filter(c => c.id !== this.currentCollecteur!.id);
      this.closeModals();
    }
  }

  addClient(): void {
    if (this.clientForm.valid) {
      const formValues = this.clientForm.value;
      const newClient: Client = {
        id: Math.max(0, ...this.clients.map(c => c.id)) + 1,
        nom: formValues.nom || '',
        prenom: formValues.prenom || '',
        sexe: formValues.sexe || '',
        email: formValues.email || '',
        telephone: formValues.telephone || ''
      };
      this.clients.push(newClient);
      this.closeClientModal();
    }
  }

  savePayment(): void {
    if (this.paymentForm.valid) {
      const formValues = this.paymentForm.value;
      const newPayment: Payment = {
        id: Math.max(0, ...this.payments.map(p => p.id)) + 1,
        clientId: Number(formValues.clientId) || 0,
        collecteurId: Number(formValues.collecteurId) || 0,
        montant: Number(formValues.montant) || 50000,
        dateEcheance: formValues.dateEcheance || '10/5/25',
        datePaiement: new Date().toLocaleDateString()
      };
      
      this.payments.push(newPayment);
      
      // Update collector performance
      this.updateCollecteurPerformance(newPayment);
      
      this.closePaymentModal();
    }
  }

  updateCollecteurPerformance(payment: Payment): void {
    const collecteurIndex = this.collecteursPerformance.findIndex(c => c.id === payment.collecteurId);
    
    if (collecteurIndex !== -1) {
      // Update existing collector's performance
      this.collecteursPerformance[collecteurIndex].montant += payment.montant;
      this.collecteursPerformance[collecteurIndex].echeances += 1;
    } else {
      // Add new collector performance record
      const collecteur = this.collecteurs.find(c => c.id === payment.collecteurId);
      if (collecteur) {
        const newPerformance: CollecteurPerformance = {
          id: collecteur.id,
          nom: collecteur.nom,
          prenom: collecteur.prenom,
          montant: payment.montant,
          echeances: 1
        };
        this.collecteursPerformance.push(newPerformance);
      }
    }
  }

  // Helper methods
  getNextId(): number {
    return Math.max(0, ...this.collecteurs.map(c => c.id)) + 1;
  }

  getTotalAmount(): number {
    return this.payments.reduce((sum, payment) => sum + payment.montant, 0);
  }

  getDailyTotal(): number {
    const today = new Date().toLocaleDateString();
    return this.payments
      .filter(payment => payment.datePaiement === today)
      .reduce((sum, payment) => sum + payment.montant, 0);
  }
}