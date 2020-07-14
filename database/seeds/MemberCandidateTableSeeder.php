<?php

use App\Models\Candidate;
use App\Models\MembersCandidate;
use Illuminate\Database\Seeder;

class MemberCandidateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $candidate = Candidate::whereName('Lista 1')->first();
        
        if ($candidate) {
            MembersCandidate::create(
                [
                    'candidate_id' => $candidate->id,
                    'name' => 'Ldco. Fernando Solorzano Arias',
                    'position' => 'Secretario General'
                ]
            );

            MembersCandidate::create(
                [
                    'candidate_id' => $candidate->id,
                    'name' => 'Abg. Sandra Pesantez Ruiz',
                    'position' => 'Prosecretario General'
                ]
            );

            MembersCandidate::create(
                [
                    'candidate_id' => $candidate->id,
                    'name' => 'Ing. Luis Regalado Macias',
                    'position' => 'Tesprero'
                ]
            );

            MembersCandidate::create(
                [
                    'candidate_id' => $candidate->id,
                    'name' => 'Abg. Juana Beltran Ruiz',
                    'position' => 'Secretario de Actas y Comunicaciones'
                ]
            );

            MembersCandidate::create(
                [
                    'candidate_id' => $candidate->id,
                    'name' => 'Abg. Concepcion Tomala Sanchez',
                    'position' => 'Secretario de Defensa Jurídica'
                ]
            );

            MembersCandidate::create(
                [
                    'candidate_id' => $candidate->id,
                    'name' => 'Abg. Kenia Moreno Muñoz',
                    'position' => 'Secretario de Organización y Disciplina'
                ]
            );

            MembersCandidate::create(
                [
                    'candidate_id' => $candidate->id,
                    'name' => 'Ec. Adriana Burgos Mera',
                    'position' => 'Secretario de Economía y Finanzas'
                ]
            );

            MembersCandidate::create(
                [
                    'candidate_id' => $candidate->id,
                    'name' => 'Lcda. Jessica Di Puglia Lara',
                    'position' => 'Secretaria de Asuntos Sociales'
                ]
            );

            MembersCandidate::create(
                [
                    'candidate_id' => $candidate->id,
                    'name' => 'Ing. Jose Lucin Uruchima',
                    'position' => 'Secretario de Deportes'
                ]
            );

            MembersCandidate::create(
                [
                    'candidate_id' => $candidate->id,
                    'name' => 'Ing. Grace Pesántez Almeida',
                    'position' => 'Secretaria de la Mujer'
                ]
            );

            MembersCandidate::create(
                [
                    'candidate_id' => $candidate->id,
                    'name' => 'Ing. Jose Regalado Morales',
                    'position' => 'Secretario de Seguridad Industrial y Medio Ambiente'
                ]
            );

            MembersCandidate::create(
                [
                    'candidate_id' => $candidate->id,
                    'name' => 'Lcda. Alexandra Torres Toledo',
                    'position' => 'Secretario de Asuntos Intersindicales'
                ]
            );

            MembersCandidate::create(
                [
                    'candidate_id' => $candidate->id,
                    'name' => 'Juan Carlos Cordova Garcia',
                    'position' => 'Secretario de Derechos Humanos'
                ]
            );

            MembersCandidate::create(
                [
                    'candidate_id' => $candidate->id,
                    'name' => 'Ing. José Reinaldo Moscoso Florencia',
                    'position' => 'Secretario de Cultura'
                ]
            );
            
            MembersCandidate::create(
                [
                    'candidate_id' => $candidate->id,
                    'name' => 'Ing. Daniel Enrique Navarrete García',
                    'position' => 'Secretario de Prensa y Propaganda'
                ]
            );
            
            MembersCandidate::create(
                [
                    'candidate_id' => $candidate->id,
                    'name' => 'Mgs. Mariela Boloña Hidalgo',
                    'position' => 'Secretario de Capacitaciones'
                ]
            );
            
            MembersCandidate::create(
                [
                    'candidate_id' => $candidate->id,
                    'name' => 'Ing. Christian Calderon Elias',
                    'position' => 'Secretario de Inclusión y Defensa de Grupos Prioritarios'
                ]
            );
            
            MembersCandidate::create(
                [
                    'candidate_id' => $candidate->id,
                    'name' => 'Ibsen Javier Zambrano Orellana',
                    'position' => 'Secretario de Educación Sindical'
                ]
            );
        }
    }
}
