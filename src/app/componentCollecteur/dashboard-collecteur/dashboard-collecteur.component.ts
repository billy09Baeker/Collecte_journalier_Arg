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
  telephone: string;}
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

  showAddModal = false;
  showEditModal = false;
  showDeleteModal = false;
  currentCollecteur: Collecteur | null = null;

  collecteurForm = new FormGroup({
    nom: new FormControl('', Validators.required),
    prenom: new FormControl('', Validators.required),
    sexe: new FormControl('', Validators.required),
    email: new FormControl('', [Validators.required, Validators.email]),
    telephone: new FormControl('', Validators.required)
  });

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

  closeModals(): void {
    this.showAddModal = false;
    this.showEditModal = false;
    this.showDeleteModal = false;
    this.resetForm();
  }

  resetForm(): void {
    this.collecteurForm.reset();
    this.currentCollecteur = null;
  }

  addCollecteur(): void {
    if (this.collecteurForm.valid) {
      const newCollecteur: Collecteur = {
        id: this.getNextId(),
        ...this.collecteurForm.value as Omit<Collecteur, 'id'>
      };
      this.collecteurs.push(newCollecteur);
      this.closeModals();
    }
  }

  updateCollecteur(): void {
    if (this.collecteurForm.valid && this.currentCollecteur) {
      const index = this.collecteurs.findIndex(c => c.id === this.currentCollecteur!.id);
      if (index !== -1) {
        this.collecteurs[index] = {
          id: this.currentCollecteur.id,
          ...this.collecteurForm.value as Omit<Collecteur, 'id'>
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

  getNextId(): number {
    return Math.max(0, ...this.collecteurs.map(c => c.id)) + 1;
  }

}