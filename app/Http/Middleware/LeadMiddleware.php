<?php

namespace App\Http\Middleware;

use Closure;
use App\Model\Lead;
use App\Http\Exceptions\ForbiddenException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LeadMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $request->attributes->add($request->route()[2]);
        logInfo(json_encode($request->route()[2]));
        if (empty($request->get('leadId')) === false) {
            $lead = Lead::find($request->get('leadId'), ['id', 'report_id', 'client_id', 'inspection_type', 'vehicle_category_id', 'registration_status', 'registration_type', 'registration_number', 'loan_agreement_number', 'model_number', 'engine_number', 'chassis_number', 'number_of_owners', 'mfg_date', 'reg_date', 'lead_status_id', 'customer_id',  'executive_details_id', 'created_at']);

            if (empty($lead->id) === true) {
                throw new ModelNotFoundException();
            }

            $request->attributes->add([
                'lead' => $lead,
                'leadId' => $lead->id
            ]);
        } else {
            throw new ModelNotFoundException();
        }

        return $next($request);
    }
}
