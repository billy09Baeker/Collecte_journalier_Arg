import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { DatePipe } from '@angular/common';

interface Collecteur {
  id: number;
  nom: string;
  prenom: string;
  montantTotal: number;
  nombreClients: number;
  zoneCouverture: string;
  performance: 'faible' | 'moyenne' | 'bonne' | 'excellente';
}

interface StatistiquesJournalieres {
  date: Date;
  montantTotalJour: number;
  nombreClientsTotal: number;
  nombreCollecteurs: number;
}

@Component({
  selector: 'app-performance',
  standalone: true,
  imports: [CommonModule],
  providers: [DatePipe],
  templateUrl: './performance.component.html',
  styleUrl: './performance.component.scss'
})
export class PerformanceComponent implements OnInit {
  collecteurs: Collecteur[] = [];
  statsJour: StatistiquesJournalieres;
  aujourdhui: Date = new Date();
  
  constructor(private datePipe: DatePipe) {
    // Initialisation des statistiques journalières
    this.statsJour = {
      date: this.aujourdhui,
      montantTotalJour: 0,
      nombreClientsTotal: 0,
      nombreCollecteurs: 0
    };
  }
  
  ngOnInit(): void {
    this.genererDonnees();
    this.calculerStatistiquesJournalieres();
  }
  
  genererDonnees(): void {
    // Générer des données de collecteurs fictives
    this.collecteurs = [
      {
        id: 1,
        nom: 'Dubois',
        prenom: 'Jean',
        montantTotal: 2350.50,
        nombreClients: 18,
        zoneCouverture: 'Centre-ville',
        performance: 'excellente'
      },
      {
        id: 2,
        nom: 'Martin',
        prenom: 'Sophie',
        montantTotal: 1875.00,
        nombreClients: 15,
        zoneCouverture: 'Nord',
        performance: 'bonne'
      },
      {
        id: 3,
        nom: 'Leroy',
        prenom: 'Michel',
        montantTotal: 950.75,
        nombreClients: 8,
        zoneCouverture: 'Sud',
        performance: 'moyenne'
      },
      {
        id: 4,
        nom: 'Petit',
        prenom: 'Marie',
        montantTotal: 3100.25,
        nombreClients: 22,
        zoneCouverture: 'Est',
        performance: 'excellente'
      },
      {
        id: 5,
        nom: 'Thomas',
        prenom: 'Lucas',
        montantTotal: 750.00,
        nombreClients: 6,
        zoneCouverture: 'Ouest',
        performance: 'faible'
      }
    ];
  }
  
  calculerStatistiquesJournalieres(): void {
    // Calculer les statistiques journalières à partir des données de collecteurs
    let montantTotal = 0;
    let nombreClientsTotal = 0;
    
    this.collecteurs.forEach(collecteur => {
      montantTotal += collecteur.montantTotal;
      nombreClientsTotal += collecteur.nombreClients;
    });
    
    this.statsJour = {
      date: this.aujourdhui,
      montantTotalJour: montantTotal,
      nombreClientsTotal: nombreClientsTotal,
      nombreCollecteurs: this.collecteurs.length
    };
  }
  
  getPerformanceClass(performance: string): string {
    switch (performance) {
      case 'excellente':
        return 'performance-excellente';
      case 'bonne':
        return 'performance-bonne';
      case 'moyenne':
        return 'performance-moyenne';
      case 'faible':
        return 'performance-faible';
      default:
        return '';
    }
  }
  
  calculerMoyenneParClient(collecteur: Collecteur): number {
    if (collecteur.nombreClients === 0) return 0;
    return collecteur.montantTotal / collecteur.nombreClients;
  }
  
  calculerPourcentageContribution(collecteur: Collecteur): number {
    if (this.statsJour.montantTotalJour === 0) return 0;
    return (collecteur.montantTotal / this.statsJour.montantTotalJour) * 100;
  }
}