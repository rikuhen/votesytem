<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableVotes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('votes', function (Blueprint $table) {
            $table->integer('dignity_id');
            $table->renameColumn('candidate_id', 'list_vote_id');
            $table->enum('type', ['white', 'nulled', 'normal']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('votes', 'type')) {
            Schema::table('votes', function (Blueprint $table) {
                $table->dropColumn('type');
            });
        }

        Schema::table('votes', function (Blueprint $table) {
            $table->dropColumn('dignity_id');
            $table->renameColumn('list_vote_id', 'candidate_id');
        });
    }
}
