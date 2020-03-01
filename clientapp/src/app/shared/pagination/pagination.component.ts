import { Component, OnInit, Input, Output, EventEmitter } from '@angular/core';

@Component({
  selector: 'app-pagination',
  templateUrl: './pagination.component.html',
  styleUrls: ['./pagination.component.scss']
})
export class PaginationComponent implements OnInit {

  constructor() { }

  ngOnInit(): void {
  }
  @Input() pager: any ={};
  @Output() currentPage = new EventEmitter<number>();

  setPage(page: number) {
    this.currentPage.emit(page);
  }

}
