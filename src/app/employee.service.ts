import { Injectable } from '@angular/core';
import { HttpClient,HttpHeaders } from '@angular/common/http';
import { Observable, of } from 'rxjs';
import {Employee} from './Employee';
import { catchError, map, tap } from 'rxjs/operators';
@Injectable({
  providedIn: 'root'
})
export class EmployeeService {
const TOKEN = 'TOKEN';
 setToken(token: string): void {
    localStorage.setItem(TOKEN, token);
  }

  isLogged() {
    return localStorage.getItem(TOKEN) != null;
  }
  constructor(private http:HttpClient) { }
  E_url = 'http://localhost/php/';
  I_url = 'http://localhost/php/create.php';
  
  login(email: string, password: string){
    return this.http.post('https://reqres.in/api/login', {
      email: email,
      password: password
    });
  }
  getEmployees():Observable<Employee[]> {
  	return  this.http.get<Employee[]>(this.E_url).pipe(
      tap(_ => this.log(`List all employess`)),
      catchError(this.handleError<any>('getEmployees'))
      );;
  }


  private log(message: string) {
    console.log(message);  
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


  httpOptions = {
    headers: new HttpHeaders({ 'Content-Type': 'application/json' })
  };

  addHero (employee) {

    return this.http.post(this.I_url, { employee }).pipe(tap(_ =>this.log('EMployes addad')));

  }

  getEmployee(id: number)  {
    // TODO: send the message _after_ fetching the hero

    const get_url = 'http://localhost/php/update.php?id='+id;
    return this.http.get(get_url);
  }
  
  updateEmployee(employee:Employee){
    const get_url = 'http://localhost/php/update.php';
    return this.http.put(get_url,employee);

  }
  deleteEmployee(id:number){
    const get_url = 'http://localhost/php/delete.php?id='+id;

    return this.http.delete(get_url);
  }
}
