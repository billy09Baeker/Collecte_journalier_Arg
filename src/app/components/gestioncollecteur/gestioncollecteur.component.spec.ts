import { ComponentFixture, TestBed } from '@angular/core/testing';

import { GestioncollecteurComponent } from './gestioncollecteur.component';

describe('GestioncollecteurComponent', () => {
  let component: GestioncollecteurComponent;
  let fixture: ComponentFixture<GestioncollecteurComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [GestioncollecteurComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(GestioncollecteurComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
