import { Routes } from '@angular/router';
import { LoginComponent } from './components/login/login.component';
import { DashboardComponent } from './components/dashboard/dashboard.component';
import { GestioncollecteurComponent } from './components/gestioncollecteur/gestioncollecteur.component';
import { GestionclientComponent } from './components/gestionclient/gestionclient.component';
import { SuivistransComponent } from './components/suivistrans/suivistrans.component';
import { PerformanceComponent } from './components/performance/performance.component';
import { DashboardCollecteurComponent } from './componentCollecteur/dashboard-collecteur/dashboard-collecteur.component';

export const routes: Routes = [
{ path: '', component: LoginComponent },
{ path: 'login', component: LoginComponent },
{path: 'dashboard',component: DashboardComponent},
{path: 'gestioncollecteur',component: GestioncollecteurComponent},
{path: 'gestionclient',component: GestionclientComponent},
{path: 'suivistrans', component: SuivistransComponent},
{path: 'performance', component: PerformanceComponent},
{path: 'dashboardcollecteur', component: DashboardCollecteurComponent},


];
