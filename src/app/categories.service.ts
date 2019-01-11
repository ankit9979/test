import { Injectable } from '@angular/core';
import {Category} from './category';
import { Observable, of } from 'rxjs';
import {CATEGORIES} from './mock';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { catchError, map, tap } from 'rxjs/operators';
@Injectable({
	providedIn: 'root'
})
export class CategoriesService {

	constructor(private http: HttpClient) { }

	private cUrl = 'api/categories';
	getCategories():Observable<Category[]>{
		return this.http.get<Category[]>(this.cUrl).pipe(
			catchError(this.handleError('getHeroes', []))
			);
	}



	private handleError<T> (operation = 'operation', result?: T) {
		return (error: any): Observable<T> => {

			// TODO: send the error to remote logging infrastructure
			console.error(error); // log to console instead

			// TODO: better job of transforming error for user consumption
			this.log(`${operation} failed: ${error.message}`);

			// Let the app keep running by returning an empty result.
			return of(result as T);
		};
	}

	
	private log(message: string) {
		// this.messageService.add(`HeroService: ${message}`);
	}
}
