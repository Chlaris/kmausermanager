<?php

declare(strict_types=1);

namespace OCA\KMAUserManager\Migration;

use Closure;
use Doctrine\DBAL\Types;
use OCP\DB\ISchemaWrapper;
use OCP\Migration\IOutput;
use OCP\Migration\SimpleMigrationStep;
use phpDocumentor\Reflection\PseudoTypes\False_;

/**
 * Auto-generated migration step: Please modify to your needs!
 */
class Version1000Date20221229181522 extends SimpleMigrationStep {

	/**
	 * @param IOutput $output
	 * @param Closure $schemaClosure The `\Closure` returns a `ISchemaWrapper`
	 * @param array $options
	 */
	public function preSchemaChange(IOutput $output, Closure $schemaClosure, array $options): void {
	}

	/**
	 * @param IOutput $output
	 * @param Closure $schemaClosure The `\Closure` returns a `ISchemaWrapper`
	 * @param array $options
	 * @return null|ISchemaWrapper
	 */
	public function changeSchema(IOutput $output, Closure $schemaClosure, array $options): ?ISchemaWrapper {
		/** @var ISchemaWrapper $schema */
		$schema = $schemaClosure();

		// kma_user, kma_relations

		if (!$schema->hasTable('kma_user')){
			$table = $schema->createTable('kma_user');
			$table->addColumn('kma_uid', 'string', [
				'notnull' => true,
				'length' => 64,
				'default' => '',
			]);

			$table->addColumn('full_name', 'string', [
				'notnull' => true,
				'length' => 64
			]);

			$table->addColumn('date_of_birth', 'date', [
				'notnull' => false,
			]);

			$table->addColumn('gender', 'boolean', [
				'notnull' => false
			]);

			$table->addColumn('phone', 'string', [
				'notnull' => false,
				'length' => 20,
				'default' => '',
			]);

			$table->addColumn('address', 'string', [
				'notnull' => false,
				'length' => 255,
				'default' => '',
			]);

			$table->addColumn('id_number', 'string', [
				'notnull' => true,
				'length' => 12,
			]);

			$table->addColumn('email', 'string', [
				'notnull' => false,
				'length' => 255,
				'default' => '',
			]);

			$table->addColumn('position_id', 'integer', [
				'notnull' => true,
				'length' => 64,
				'unsigned' => true
			]);

			$table->addColumn('salary', 'integer', [
				'notnull' => true,
				'length' => 10,
				'default' => 10000000
			]);

			$table->addColumn('coefficients_salary', 'integer', [
				'notnull' => true,
				'length' => 10,
				'default' => 1
			]);

			$table->addColumn('tax', 'integer', [
				'notnull' => true,
				'length' => 10,
				'default' => 10
			]);

			$table->addColumn('day_joined', 'date', [
				'notnull' => false

			]);

			$table->addColumn('communist_party_joined', 'date', [
				'notnull' => false,
			]);

			$table->addColumn('communist_party_confirmed', 'date', [
				'notnull' => false,
			]);

			$table->addColumn('unit_id', 'string', [
				'unsigned' => true
			]);

			$table->setPrimaryKey(['kma_uid']);
			// $table->addIndex(['id_number'], 'kma_user');
			// $table->addIndex(['position_id'], 'kma_user');
			// $table->addIndex(['unit_id'], 'kma_user');
			$table->addForeignKeyConstraint(
				'kma_position',
				['position_id'],
				['position_id'],
				['onDelete' => 'CASCADE']
			);
			$table->addForeignKeyConstraint(
				'kma_unit',
				['unit_id'],
				['unit_id'],
				['onDelete' => 'CASCADE']
			);
			
		}


		if (!$schema->hasTable('kma_relations')) {
			$table = $schema->createTable('kma_relations');
			$table->addColumn('relations_id', 'integer', [
				'notnull' => true,
				'length' => 64,
				'autoincrement' => true
			]);

			$table->addColumn('kma_uid', 'string', [
				'unsigned' => true
			]);

			$table->addColumn('full_name', 'string', [
				'notnull' => true,
				'length' => 64,
			]);

			$table->addColumn('date_of_birth', 'date', [
				'notnull' => false
			]);

			$table->addColumn('phone', 'integer', [
				'notnull' => false,
				'length' => 10
			]);

			$table->addColumn('address', 'string', [
				'notnull' => false,
				'length' => 255
			]);

			$table->addColumn('relationship', 'string', [
				'notnull' => true,
				'length' => 255
			]);
			$table->setPrimaryKey(['relations_id']);
			// $table->addIndex(['kma_uid'], 'kma_relations_uid');
			$table->addForeignKeyConstraint(
				'kma_user',
				['kma_uid'],
				['kma_uid'],
				['onDelete' => 'CASCADE']
			);
		}

		// kma_education, kma_business_leave

        if (!$schema->hasTable('kma_education')) {
			$table = $schema->createTable('kma_education');
			$table->addColumn('education_id', 'integer', [
				'notnull' => true,
				'length' => 64,
				'autoincrement' => true
			]);

			$table->addColumn('kma_uid', 'string', [
				'unsigned' => true
			]);

			$table->addColumn('graduate_time', 'date', [
				'notnull' => true
			]);

			$table->addColumn('admision_time', 'date', [
				'notnull' => true
			]);

			$table->addColumn('training_unit', 'string', [
				'notnull' => true,
				'length' => 64
			]);

			$table->addColumn('specialization', 'string', [
				'notnull' => true,
				'length' => 64
			]);

			$table->addColumn('diploma', 'string', [
				'notnull' => true,
				'length' => 64
			]);

			$table->addColumn('graduated_with', 'string', [
				'notnull' => true,
				'length' => 64
			]);

			$table->setPrimaryKey(['education_id']);
			// $table->addIndex(['kma_uid'], 'kma_education_uid');
			$table->addForeignKeyConstraint(
				'kma_user',
				['kma_uid'],
				['kma_uid'],
				['onDelete' => 'CASCADE']
			);
		}

	

		if (!$schema->hasTable('kma_business')) {
			$table = $schema->createTable('kma_business');
			$table->addColumn('business_id', 'string', [
				'notnull' => true,
				'length' => 64,
				'autoincrement' => true
			]);

			$table->addColumn('kma_uid', 'string', [
				'unsigned' => true
			]);

			$table->addColumn('start_time', 'date', [
				'notnull' => false
			]);

			$table->addColumn('end_time', 'date', [
				'notnull' => false
			]);

			$table->addColumn('unit', 'string', [
				'notnull' => true,
				'length' => 255
			]);

			$table->addColumn('position', 'string', [
				'notnull' => true,
				'length' => 255
			]);

			$table->setPrimaryKey(['business_id']);
			// $table->addIndex(['kma_uid'], 'kma_business_uid');
			$table->addForeignKeyConstraint(
				'kma_user',
				['kma_uid'],
				['kma_uid'],
				['onDelete' => 'CASCADE']
			);
		}

		// kma_position, kma_unit, kma_bonus, kma_cell
        
        if (!$schema->hasTable('kma_position')) {
			$table = $schema->createTable('kma_position');
			$table->addColumn('position_id', 'integer', [
				'autoincrement' => true,
				'notnull' => true,
				'length' => 64
			]);
			$table->addColumn('position_name', 'string', [
				'notnull' => false,
				'length' => 255
			]);
			
			$table->addColumn('allowance', 'integer', [
				'notnull' => false,
			]);

			$table->addColumn('remark', 'string', [
				'notnull' => false,
				'length' => 255
			]);

			$table->setPrimaryKey(['position_id']);
		}


		if (!$schema->hasTable('kma_unit')) {
			$table = $schema->createTable('kma_unit');
			$table->addColumn('unit_id', 'string', [
				'notnull' => true,
				'length' => 64,
				'autoincrement' => true
			]);

			$table->addColumn('unit_name', 'string', [
				'notnull' => true,
				'length' => 255
			]);
			
			$table->addColumn('description', 'string', [
				'notnull' => false,
				'length' => 255
			]);

			$table->addColumn('chief_unit', 'string', [
				'unsigned' => true
			]);

			$table->addColumn('deputy_unit', 'string', [
				'unsigned' => true
			]);

			$table->addColumn('parent_unit', 'string', [
				'unsigned' => true
			]);

			$table->setPrimaryKey(['unit_id']);		
		}

		if (!$schema->hasTable('kma_bonus')) {
			$table = $schema->createTable('kma_bonus');
			$table->addColumn('bonus_id', 'integer', [
				'notnull' => true,
				'autoincrement' => true
			]);

			$table->addColumn('form', 'string', [
				'notnull' => true,
				'length' => 64,
			]);

			$table->addColumn('time', 'date', [
				'notnull' => true,
			]);
			
			$table->addColumn('reason', 'string', [
				'notnull' => false,
				'length' => 255
			]);

			$table->addColumn('number_decision', 'integer', [
				'notnull' => false,
			]);

			$table->addColumn('department_decision', 'integer', [
				'notnull' => false,
			]);
			
			$table->setPrimaryKey(['bonus_id']);
		}

		if (!$schema->hasTable('kma_cell')) {
			$table = $schema->createTable('kma_cell');
			$table->addColumn('cell_id', 'string', [
				'notnull' => true,
				'length' => 64,
				'autoincrement' => true
			]);

			$table->addColumn('cell_name', 'string', [
				'notnull' => true,
				'length' => 255
			]);
			
			$table->addColumn('description', 'string', [
				'notnull' => false,
				'length' => 255
			]);
			$table->addColumn('unit_id', 'string', [
				'unsigned' => true
			]);

			$table->addColumn('secretary_id', 'string', [
				'notnull' => true,
				'length' => 64,
			]);

			$table->addColumn('vice_secretary_id', 'string', [
				'notnull' => true,
				'length' => 64,
			]);

			$table->addColumn('executive_committee_1st', 'string', [
				'notnull' => true,
				'length' => 64,
			]);

			$table->addColumn('executive_committee_2nd', 'string', [
				'notnull' => true,
				'length' => 64,
			]);

			$table->setPrimaryKey(['cell_id']);
			// $table->addIndex(['unit_id'], 'cell_unit_id');
			// $table->addIndex(['secretary_id'], 'cell_secretary_id');
			// $table->addIndex(['vice_secretary_id'], 'cell_vice_secretary_id');
			$table->addForeignKeyConstraint(
				'kma_unit',
				['unit_id'],
				['unit_id'],
				['onDelete' => 'CASCADE']
			);
		}

		if (!$schema->hasTable('kma_user_position_unit')){
			$table = $schema->createTable('kma_user_position_unit');

			$table->addColumn('kma_id', 'string', [
				'notnull' => true,
				'length' => 64,
				'autoincrement' => true
			]);

			$table->addColumn('kma_uid', 'string', [
				'unsigned' => true
			]);

			$table->addColumn('position_id', 'string', [
				'unsigned' => true
			]);

			$table->addColumn('unit_id', 'string', [
				'unsigned' => true
			]);

			$table->addColumn('start_time', 'date', [
				'notnull' => false
			]);

			$table->addColumn('end_time', 'date', [
				'notnull' => false
			]);

			$table->addColumn('allowance', 'integer', [
				'notnull' => false,
			]);

			$table->addColumn('file', 'string', [
				'notnull' => false,
			]);

			$table->setPrimaryKey(['kma_id']);
			// $table->addIndex(['kma_uid'], 'kma_user_position_unit');
			// $table->addIndex(['position_id'], 'kma_user_position_unit');
			// $table->addIndex(['unit_id'], 'kma_user_position_unit');
			$table->addForeignKeyConstraint(
				'kma_user',
				['kma_uid'],
				['kma_uid'],
				['onDelete' => 'CASCADE']
			);
			$table->addForeignKeyConstraint(
				'kma_position',
				['position_id'],
				['position_id'],
				['onDelete' => 'CASCADE']
			);
			$table->addForeignKeyConstraint(
				'kma_unit',
				['unit_id'],
				['unit_id'],
				['onDelete' => 'CASCADE']
			);

		}

		return $schema;
	}

	/**
	 * @param IOutput $output
	 * @param Closure $schemaClosure The `\Closure` returns a `ISchemaWrapper`
	 * @param array $options
	 */
	public function postSchemaChange(IOutput $output, Closure $schemaClosure, array $options): void {
	}
}
