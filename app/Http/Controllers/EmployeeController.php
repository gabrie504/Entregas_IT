<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{

    public function indexMenu()
    {
        
        return view('Empleados.menuEmpleados');
    }


    public function index()
    {
        $employees = Employee::with('department')->get();
        $departments = Department::all();
        return view('Empleados.agregar', compact('employees' , 'departments'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('employees.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:employees',
            'phone' => 'required',
            'designation' => 'required',
            'department_id' => 'required|exists:departments,id',
        ]);

        Employee::create($validatedData);

        return redirect()->route('Empleados.lista')->with('success', 'actulice la pagina para ver cambios.');
    }

    public function edit($id)
    {
        $departments = Department::all();
        $employee = Employee::find($id);
        return view('Empleados.editar', compact('id', 'departments', 'employee'));
    }

    public function editDepto($id)
    {
        $departments = Department::find($id);
        return view('Empleados.Departamentos.editar', compact('id', 'departments'));
    }

    public function update(Request $request , $id)
    {

        
   
        $validatedData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email' ,
            'phone' => 'required',
            'designation' => 'required',
            'department_id' => 'required|exists:departments,id',
        ]);
      

        DB::table('employees')
        ->where('id', $id)
        ->update($validatedData);


        return redirect()->route('Empleados.lista')->with('success', 'actulice la pagina para ver cambios');
    }


    public function updateDepto(Request $request , $id)
    {

        
   
        $validatedData = $request->validate([
            'name' => 'required',

        ]);
      

        DB::table('departments')
        ->where('id', $id)
        ->update($validatedData);


        return redirect()->route('Departamentos.lista')->with('success', 'actulice la pagina para ver cambios');
    }

    public function destroy($id)
    {
        //dd($id);
        $empleado = Employee::findOrFail($id);
        $empleado->delete();

        return redirect()->back()->with('success', 'Empleado eliminado correctamente.');
    }

    
    public function destroyDepto($id)
    {
        //dd($id);
        $departamento = Department::findOrFail($id);
        $departamento->delete();

        return redirect()->back()->with('success', 'Departamento eliminado correctamente.');
    }

    public  function mostrarLista(){
        $empleados = DB::table('employees')
        ->join('departments', 'departments.id', '=', 'employees.department_id')
        ->select(DB::raw('CONCAT(employees.first_name, " ", employees.last_name) AS full_name'), 'employees.designation', 'employees.email','employees.phone' ,'departments.name', 'employees.id') // Añadimos 'employees.id' a la lista de selección
        ->orderBy('employees.id', 'desc') 
        ->distinct()
        ->paginate(15);
    
    
        return view('Empleados.listaEmpleados' , compact('empleados'));
    } 

    public  function mostrarListaDepto(){
        $departamentos = DB::table('departments')
        ->orderBy('id', 'desc') 
        ->distinct()
        ->paginate(15);
    
    
    
        return view('Empleados.Departamentos.listaDepartamentos' , compact('departamentos'));
    } 

    public function indexDepartamento(){
        return view('Empleados.Departamentos.menuDepartamentos');
    }

    public function agregarDepartamento(){
        return view('Empleados.Departamentos.agregar');
    }


    public function storeDepartamento(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        Department::create($validatedData);

        return redirect()->route('Departamentos.agregar')->with('success', 'actulice la pagina para ver cambios.');
    }
    
}
