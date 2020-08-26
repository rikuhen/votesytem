<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableCandidates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('candidates', 'list_votes');
        Schema::table('list_votes', function (Blueprint $table) {
            $table->dropColumn('type');
        });

        Schema::rename('members_candidates','candidate_list_votes');
        Schema::table('candidate_list_votes', function (Blueprint $table) {
            $table->renameColumn('candidate_id','list_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('list_votes', 'candidates');
        Schema::table('candidates', function (Blueprint $table) {
            $table->enum('type', ['candidate', 'nulled', 'white']);
        });

        Schema::rename('candidate_list_votes','members_candidates');
        Schema::table('members_candidates', function (Blueprint $table) {
            $table->renameColumn('list_id','candidate_id');
        });
    }
}
