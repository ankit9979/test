import { Component, OnInit } from '@angular/core';
import {Employee} from '../Employee';
import {EmployeeService} from '../employee.service';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import {  FileUploader, FileSelectDirective } from 'ng2-file-upload/ng2-file-upload';
const I_url = 'http://localhost/php/create.php';
@Component({
	selector: 'app-employees',
	templateUrl: './employees.component.html',
	styleUrls: ['./employees.component.css']
})
export class EmployeesComponent implements OnInit {
	employees:Employee[];
	employe:Employee[];

	registerForm: FormGroup;
	submitted = false;
	registerForm2: FormGroup;

	email = 'peter@klaven';
	password = 'cityslicka';
	constructor(private employeeService:EmployeeService, private formBuilder:FormBuilder) { }
	data: any = {};
	//	datas: any = {};
	get f() { return this.registerForm.controls; }
	get fs() { return this.registerForm2.controls; }

	public uploader: FileUploader = new FileUploader({url: I_url, itemAlias: 'photo'});
	
	ngOnInit() {

		this.uploader.onAfterAddingFile = (file) => { file.withCredentials = false; };
		this.uploader.onCompleteItem = (item: any, response: any, status: any, headers: any) => {
			console.log('ImageUpload:uploaded:', item, status, response);
			alert('File uploaded successfully');
		};
		this.registerForm = this.formBuilder.group({

			name:['',Validators.required],

			address:['',Validators.required],

			salary:['',Validators.required]

		});
		this.registerForm2 = this.formBuilder.group({

			name:['',Validators.required],

			address:['',Validators.required],

			salary:['',Validators.required],
			id:['',Validators.required]
		});
		this.getEmployees();
	}

	getEmployees(){
		this.employeeService.getEmployees().subscribe(
			(data:Employee[])=>{
				this.employees=data;
			}
			);
	}

	id:number;

	getEdit(employee: Employee){
		this.id  = employee.id;

		this.employeeService.getEmployee(this.id).subscribe((employe:Employee[])=>{
			this.employe=employe;
		}
		);
	}
	onSubmit() {
		this.submitted = true;

		// stop here if form is invalid
		if (this.registerForm.invalid) {
			return;
		}

		this.employeeService.addHero(JSON.stringify(this.registerForm.value)).subscribe(data => {
			console.log("POST Request is successful ", data);this.getEmployees();
			this.registerForm = this.formBuilder.group({

				name:[''],

				address:[''],

				salary:[''],
				id:['']
			});
		},
		error => {
			console.log("Error", error);
		});


	}

	onUpdate(){
		this.submitted = true;
		this.employeeService.updateEmployee( this.registerForm2.value ).subscribe(data => {
			this.getEmployees();
			this.registerForm2 = this.formBuilder.group({

				name:[''],

				address:[''],

				salary:[''],
				id:['']
			});
		},
		error => {
			console.log("Error", error);
		});
		
		
	}
	delete(employee:Employee){
		this.employeeService.deleteEmployee(employee.id).subscribe(data=>{

			this.getEmployees();
		});
	}
	tryLogin() {
    this.employeeService.login(
      this.email,
      this.password
    )
      .subscribe(
        r => {
          if (r.token) {
          //  this.customer.setToken(r.token);
          //  this.router.navigateByUrl('/dashboard');
          }
        },
        r => {
          alert(r.error.error);
        });
  }

}
