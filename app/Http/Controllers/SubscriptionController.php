<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Subscription;

    class SubscriptionController extends Controller
    {
        public function index()
    {
        $user = auth()->user();
        if ($user->hasActiveSubscription()) {
            return redirect('/'); // O la página que corresponda
        }

        return view('subscriptions');
    }

    public function subscribe(Request $request)
    {
        $user = auth()->user();
        $plan = $request->input('plan'); // 3_months, 6_months, 12_months

        $startDate = now();
        $endDate = $startDate->copy()->addMonths(intval(substr($plan, 0, 1)));

        Subscription::create([
            'user_id' => $user->id,
            'plan' => $plan,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'active' => true,
        ]);

        return redirect('/'); // O la página que corresponda
    }

    public function cancel(Request $request)
    {
        $user = auth()->user();
        
        // Obtén la suscripción activa del usuario
        $subscription = Subscription::where('user_id', $user->id)
            ->where('active', true)
            ->first();
    
        if ($subscription) {
            // Cancela la suscripción
            $subscription->update(['active' => false]);
            // Puedes realizar otras acciones aquí, como enviar un correo de confirmación, etc.
            
            return redirect('/subscriptions')->with('success', 'Tu suscripción ha sido cancelada.');
        } else {
            return redirect('/')->with('error', 'No tienes una suscripción activa para cancelar.');
        }
    }
    


    public function showChangeSubscriptionForm(){
        return view('changeSubscription');
    }
    
    public function changeSubscription(Request $request)
    {
        $user = auth()->user();
        $newPlan = $request->input('new_plan'); // 3_months, 6_months, 12_months
    
        // Obtén la suscripción activa del usuario
        $subscription = Subscription::where('user_id', $user->id)
            ->where('active', true)
            ->first();
    
        if ($subscription) {
            // Calcula la nueva fecha de finalización basada en el nuevo plan
            $newEndDate = now()->copy()->addMonths(intval(substr($newPlan, 0, 1)));
    
            // Actualiza la suscripción con el nuevo plan y fecha de finalización
            $subscription->update([
                'plan' => $newPlan,
                'end_date' => $newEndDate,
            ]);
    
            // Puedes realizar otras acciones aquí, como enviar un correo de confirmación, etc.
    
             // Setear el mensaje de éxito en la sesión
            Session::flash('success', 'la subscripcion se cambio con exito');

            return back()->with('success', 'la subscripcion se cambio con exito');

           
        } else {
            return redirect('/subscriptions')->with('error', 'No tienes una suscripción activa para cambiar.');
        }
    }
    

}
