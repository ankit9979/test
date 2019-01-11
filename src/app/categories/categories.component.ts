import { Component, OnInit } from '@angular/core';
import {Category} from '../category';
import {CategoriesService} from '../categories.service';
@Component({
	selector: 'app-categories',
	templateUrl: './categories.component.html',
	styleUrls: ['./categories.component.css']
})

export class CategoriesComponent implements OnInit {
	
	categoriess:Category[]; 
	category:Category;
	
	constructor(private categoriesService:CategoriesService) { }
	
	onSelect(category:Category):void{
		this.category=category;
	}
	getCategories():void{
		 this.categoriesService.getCategories().subscribe(categoriess=>this.categoriess=categoriess);
	}
	ngOnInit() {
		this.getCategories();
	}

}
