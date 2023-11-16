<?php

namespace Tests\Feature;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Ticket;
use App\Models\Trip;
use App\Models\Voucher;
use App\Http\Controllers\SearchController;

class SearchTicketTest extends TestCase
{
    use RefreshDatabase,WithoutMiddleware;

    public function testSuccessfulSearch()
    {
        // Crear instancias de modelos necesarios para la prueba
        $trip = Trip::create([
            'origin' => 'Antofagasta',
            'destination' =>'Calama',
            'qtySeats' =>'28',
            'price' => '1000',
        ]);
        $ticket = Ticket::create([
            'code' => 'ABC123',
            'tripId' => $trip->id,
            'seat' => '2',
            'total'=>'2000',
            'date' =>'2023-12-11',
        ]);
        $voucher = Voucher::create([
            'ticketId' => $ticket->id,
            'uri' =>'uriExample',
            'date' => '2023-11-12',
        ]);
    
    
        // Realizar una solicitud simulada al endpoint 'search.result' del controlador
        $response = $this->post(route('search.result'), ['code' => 'ABC123']);
    
    
        $response->assertStatus(200);
    
    
        // Verificar que la vista tiene los datos esperados
        $response->assertViewHas('ticket', $ticket);
        $response->assertViewHas('trip', $trip);
        $response->assertViewHas('voucher', $voucher);
    }
    
    public function testFailedSearch()
    {
        // Acción: Realizar solicitud de búsqueda fallida
        $response = $this->post(route('search'), ['code' => 'invalid_code']);

        // Verificación: Comprobar si se redirige de vuelta con un mensaje de error
        $response->assertRedirect()->assertSessionHas('error', 'La reserva invalid_code no existe en el sistema');
    }

    public function testEmptySearch()
    {
        // Acción: Realizar solicitud de búsqueda con campo vacío
        $response = $this->post(route('search'), []);

        // Verificación: Comprobar si se redirige de vuelta con un mensaje de error
        $response->assertRedirect()->assertSessionHasErrors('code', 'Debe proporcionar código de reserva');
    }


}
