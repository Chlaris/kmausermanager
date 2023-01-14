<?php

declare(strict_types=1);

namespace OCA\KMAUserManager\Migration;

use Closure;
use Doctrine\DBAL\Types;
use OCP\DB\ISchemaWrapper;
use OCP\Migration\IOutput;
use OCP\Migration\SimpleMigrationStep;

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

		if (!$schema->hasTable('kma_canbo')){
			$table = $schema->createTable('kma_canbo');
			$table->addColumn('username', 'string', [
				'notnull' => true,
				'length' => 64
			]);
			$table->addColumn('ma_cv', 'string', [
				'notnull' => false,
				'length' => 64
			]);
			$table->addColumn('ma_pb', 'string', [
				'notnull' => false,
				'length' => 64
			]);
			$table->addColumn('ho_ten', 'string', [
				'notnull' => true,
				'length' => 64
			]);
			$table->addColumn('ngay_sinh', 'datetime', [
				'notnull' => false
			]);
			$table->addColumn('gioi_tinh', 'boolean', [
				'notnull' => false
			]);
			$table->addColumn('sdt', 'string', [
				'notnull' => true,
				'length' => 20
			]);
			$table->addColumn('dia_chi', 'string', [
				'notnull' => true,
				'length' => 255
			]);
			$table->addColumn('cmnd_cccd', 'string', [
				'notnull' => true,
				'length' => 12
			]);
			$table->addColumn('email', 'string', [
				'notnull' => true,
				'length' => 255
			]);
			$table->setPrimaryKey(['username']);
		}

		if (!$schema->hasTable('kma_nguoithan')) {
			$table = $schema->createTable('kma_nguoithan');
			$table->addColumn('username', 'string', [
				'notnull' => true,
				'length' => 64,
			]);
			$table->addColumn('ma_nt', 'string', [
				'notnull' => true,
				'length' => 64
			]);
			$table->addColumn('ho_ten', 'string', [
				'notnull' => true,
				'length' => 64,
			]);
			$table->addColumn('ngay_sinh', 'datetime', [
				'notnull' => false
			]);
			$table->addColumn('gioi_tinh', 'string', [
				'notnull' => false,
				'length' => 3
			]);
			$table->addColumn('sdt', 'string', [
				'notnull' => false,
				'length' => 20
			]);
			$table->addColumn('dia_chi', 'string', [
				'notnull' => false,
				'length' => 255
			]);
			$table->addColumn('nghe_nghiep', 'string', [
				'notnull' => true,
				'length' => 255
			]);
			$table->addColumn('hinh_thuc_qh', 'string', [
				'notnull' => true,
				'length' => 255
			]);
			$table->setPrimaryKey(['ma_nt']);
		}

		if (!$schema->hasTable('kma_hopdong')) {
			$table = $schema->createTable('kma_hopdong');
			$table->addColumn('ma_hd', 'string', [
				'notnull' => true,
				'length' => 64
			]);
			$table->addColumn('username', 'string', [
				'notnull' => true,
				'length' => 64
			]);
			$table->addColumn('ten_hd', 'string', [
				'notnull' => true,
				'length' => 64
			]);
			$table->addColumn('ngay_bat_dau', 'datetime', [
				'notnull' => false
			]);
			$table->addColumn('ngay_het_han', 'datetime', [
				'notnull' => false
			]);
			$table->addColumn('mo_ta', 'string', [
				'notnull' => false
			]);
			$table->addColumn('trang_thai', 'boolean', [
				'notnull' => false
			]);
			$table->setPrimaryKey(['ma_hd']);
		}

		if (!$schema->hasTable('kma_nghiphep')) {
			$table = $schema->createTable('kma_nghiphep');
			$table->addColumn('username', 'string', [
				'notnull' => true,
				'length' => 64,
			]);
			$table->addColumn('ma_np', 'string', [
				'notnull' => true,
				'length' => 64
			]);
			$table->addColumn('ngay_bat_dau', 'datetime', [
				'notnull' => false
			]);
			$table->addColumn('ngay_ket_thuc', 'datetime', [
				'notnull' => false
			]);
			$table->addColumn('so_ngay_nghi', 'integer', [
				'notnull' => false
			]);
			$table->addColumn('ly_do', 'string', [
				'notnull' => true
			]);
			$table->addColumn('trang_thai', 'boolean', [
				'notnull' => false
			]);
			$table->setPrimaryKey(['ma_np']);
		}

		if (!$schema->hasTable('kma_cong')) {
			$table = $schema->createTable('kma_cong');
			$table->addColumn('ma_cong', 'string', [
				'notnull' => true,
				'length' => 64,
			]);
			$table->addColumn('username', 'string', [
				'notnull' => true,
				'length' => 64
			]);
			$table->addColumn('ngay', 'datetime', [
				'notnull' => false
			]);
			$table->addColumn('trang_thai', 'boolean', [
				'notnull' => false
			]);
			$table->setPrimaryKey(['ma_cong']);
		}

		if (!$schema->hasTable('kma_daotao')) {
			$table = $schema->createTable('kma_daotao');
			$table->addColumn('ma_dt', 'string', [
				'notnull' => true,
				'length' => 64,
			]);
			$table->addColumn('ten', 'string', [
				'notnull' => true,
				'length' => 64
			]);
			$table->addColumn('yeu_cau', 'string', [
				'notnull' => true
			]);
			$table->addColumn('chuyen_nganh', 'string', [
				'notnull' => true,
				'length' => 64
			]);
			$table->addColumn('hinh_thuc_dt', 'string', [
				'notnull' => true,
				'length' => 64
			]);
			$table->addColumn('van_bang', 'string', [
				'notnull' => true,
				'length' => 64
			]);
			$table->setPrimaryKey(['ma_dt']);
		}

		if (!$schema->hasTable('kma_qtdaotao')) {
			$table = $schema->createTable('kma_qtdaotao');
			$table->addColumn('ma_qt_dt', 'string', [
				'notnull' => true,
				'length' => 64,
			]);
			$table->addColumn('username', 'string', [
				'notnull' => true,
				'length' => 64,
			]);
			$table->addColumn('ma_dt', 'string', [
				'notnull' => true,
				'length' => 64,
			]);
			$table->addColumn('ket_qua', 'string', [
				'notnull' => true,
				'length' => 64
			]);
			$table->addColumn('ngay_bat_dau', 'datetime', [
				'notnull' => false
			]);
			$table->addColumn('ngay_ket_thuc', 'datetime', [
				'notnull' => false
			]);
			$table->addColumn('dia_diem', 'string', [
				'notnull' => true,
				'length' => 255
			]);
			$table->setPrimaryKey(['ma_qt_dt']);
		}

		if (!$schema->hasTable('kma_qtcongtac')) {
			$table = $schema->createTable('kma_qtcongtac');
			$table->addColumn('username', 'string', [
				'notnull' => true,
				'length' => 64,
			]);
			$table->addColumn('ma_qt_ct', 'string', [
				'notnull' => true,
				'length' => 64
			]);
			$table->addColumn('ngay_bat_dau', 'datetime', [
				'notnull' => false
			]);
			$table->addColumn('ngay_ket_thuc', 'datetime', [
				'notnull' => false
			]);
			$table->addColumn('co_quan', 'string', [
				'notnull' => true,
				'length' => 255
			]);
			$table->addColumn('don_vi', 'string', [
				'notnull' => true,
				'length' => 255
			]);
			$table->addColumn('trang_thai', 'boolean', [
				'notnull' => false
			]);
			$table->setPrimaryKey(['ma_qt_ct']);
		}

		if (!$schema->hasTable('kma_luong')) {
			$table = $schema->createTable('kma_luong');
			$table->addColumn('username', 'string', [
				'notnull' => true,
				'length' => 64,
			]);
			$table->addColumn('ma_luong', 'string', [
				'notnull' => true,
				'length' => 64
			]);
			$table->addColumn('ngay_cong', 'smallint', [
				'notnull' => false
			]);
			$table->addColumn('ngay_np', 'smallint', [
				'notnull' => false
			]);
			$table->addColumn('luong_co_so', 'float', [
				'notnull' => false
			]);
			$table->addColumn('he_so_luong', 'float', [
				'notnull' => false
			]);
			$table->addColumn('phu_cap', 'float', [
				'notnull' => false
			]);
			$table->setPrimaryKey(['ma_luong']);
		}

		if (!$schema->hasTable('kma_chucvu')) {
			$table = $schema->createTable('kma_chucvu');
			$table->addColumn('ma_cv', 'string', [
				'notnull' => true,
				'length' => 64
			]);
			$table->addColumn('ten_cv', 'string', [
				'notnull' => false,
				'length' => 255
			]);
			$table->addColumn('them', 'boolean', [
				'notnull' => false
			]);
			$table->addColumn('xoa', 'boolean', [
				'notnull' => false
			]);
			$table->addColumn('sua', 'boolean', [
				'notnull' => false
			]);
			$table->setPrimaryKey(['ma_cv']);
		}

		if (!$schema->hasTable('kma_phongban')) {
			$table = $schema->createTable('kma_phongban');
			$table->addColumn('groupid', 'string', [
				'notnull' => false,
				'length' => 64
			]);
			$table->addColumn('ma_pb', 'string', [
				'notnull' => true,
				'length' => 64
			]);
			$table->addColumn('ten_pb', 'string', [
				'notnull' => false,
				'length' => 255
			]);
			$table->addColumn('sdt', 'string', [
				'notnull' => false,
				'length' => 20
			]);
			$table->addColumn('dia_chi', 'string', [
				'notnull' => false,
				'length' => 255
			]);
			$table->setPrimaryKey(['ma_pb']);
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
