import { ComponentFixture, TestBed } from '@angular/core/testing';

import { SuivistransComponent } from './suivistrans.component';

describe('SuivistransComponent', () => {
  let component: SuivistransComponent;
  let fixture: ComponentFixture<SuivistransComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [SuivistransComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(SuivistransComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
