import { ComponentFixture, TestBed } from '@angular/core/testing';

import { DashboardCollecteurComponent } from './dashboard-collecteur.component';

describe('DashboardCollecteurComponent', () => {
  let component: DashboardCollecteurComponent;
  let fixture: ComponentFixture<DashboardCollecteurComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [DashboardCollecteurComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(DashboardCollecteurComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
