<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 18-8-18
 * Time: 上午11:34
 */

//define('MaxSize', 10);
class MatrixInfo
{
    public $x;
    public $y;
    public $value;
}

class Matrix
{
    public $rows = null;
    public $cols = null;
    public $number = 0;
    public $matrixArray = array();

    public function InitMatrix()
    {
        $handle = fopen("php://stdin", "r");
        $this->GetRows($handle);
        $this->GetCols($handle);
        $arrayCount = 1;
        for ($i = 1; $i <= $this->rows; ++$i) {
            for ($j = 1; $j <= $this->cols; ++$j) {
                $tmp = rand(0, 1);
                if ($tmp == 1) {
                    $this->matrixArray[$arrayCount] = new MatrixInfo();
                    $this->matrixArray[$arrayCount]->x = $i;
                    $this->matrixArray[$arrayCount]->y = $j;
                    $this->matrixArray[$arrayCount]->value = rand(-3, 11);
                    $arrayCount++;
                    $this->number++;
                }

            }
        }
        print ("已形成随机矩阵:\r\n");
        printf("row\tcol\tvalue\r\n");
        for ($k = 1; $k <= count($this->matrixArray); ++$k) {

            printf("%d\t%d\t%d", $this->matrixArray[$k]->x,$this->matrixArray[$k]->y,$this->matrixArray[$k]->value);
            print ("\n");

        }
    }

    public function GetRows($handle) {
        print ("请输入矩阵的行数(输入q退出):\r\n");
        $data = fgets($handle);
        $data = rtrim($data, "\n");
        while ($data == '' || !is_numeric($data) && $data !='q') {
            print ("输入信息有误！请重新输入矩阵的行数(输入q退出):\r\n");
            $data = fgets($handle);
        }
        if ($data == 'q') {
            exit();
        } else {
            $this->rows = $data;
        }
    }

    public function GetCols($handle) {
        print ("请输入矩阵的列数(输入q退出):\r\n");
        $data = fgets($handle);
        $data = rtrim($data, "\n");
        while ($data == '' || !is_numeric($data) && $data !='q') {
            print ("输入信息有误！请重新输入矩阵的列数数(输入q退出):\r\n");
            $data = fgets($handle);
        }
        if ($data == 'q') {
            exit();
        } else {
            $this->cols = $data;
        }
    }

    public function  RevMatrix() {
        if (empty($this->matrixArray)) {
            print "原矩阵未初始化";
        }
        $RevMatrix = new Matrix();
        $RevMatrix->cols = $this->cols;
        $RevMatrix->rows = $this->rows;
        $RevMatrix->number = $this->number;
        $i = 1;
        while ($i <= $this->number) {
            $min = 1;
            for ($j = 2; $j <= $this->number; ++$j) {
                if ($this->matrixArray[$min]->y > $this->matrixArray[$j]->y)
                    $min = $j;
            }
            $RevMatrix->matrixArray[$i] = new MatrixInfo();
            $RevMatrix->matrixArray[$i]->x = $this->matrixArray[$min]->y;
            $RevMatrix->matrixArray[$i]->y = $this->matrixArray[$min]->x;
            $RevMatrix->matrixArray[$i]->value = $this->matrixArray[$min]->value;
            $i++;
            $this->matrixArray[$min]->y = $this->cols+1;
        }
        print ("已转置随机矩阵:\r\n");
        printf("row\tcol\tvalue\r\n");
        for ($k = 1; $k <= count($RevMatrix->matrixArray); ++$k) {
            printf("%d\t%d\t%d", $RevMatrix->matrixArray[$k]->x,$RevMatrix->matrixArray[$k]->y,$RevMatrix->matrixArray[$k]->value);
            print ("\r\n");

        }
    }

    public function QuickRevMatrix() {
        $colNum = array();
        $position = array();
        if (empty($this->matrixArray)) {
            print "原矩阵未初始化";
        }
        $RevMatrix = new Matrix();
        $RevMatrix->cols = $this->cols;
        $RevMatrix->rows = $this->rows;
        $RevMatrix->number = $this->number;
        for ($i = 1; $i <= $this->cols; ++$i) {
            $colNum[$i] = 0;
        }
        for ($i = 1; $i <= $this->number; ++$i) {
            $colNum[$this->matrixArray[$i]->y]++;
        }
        $position[1] = 1;
        for ($i = 2; $i <= $this->cols; ++$i) {
            $position[$i] = $position[$i-1] + $colNum[$i-1];
        }
        for ($i = 1; $i <= $this->number; ++$i) {
            $col = $this->matrixArray[$i]->y;
            $p = $position[$col];
            $RevMatrix->matrixArray[$p] = new MatrixInfo();
            $RevMatrix->matrixArray[$p]->x = $this->matrixArray[$i]->y;
            $RevMatrix->matrixArray[$p]->y = $this->matrixArray[$i]->x;
            $RevMatrix->matrixArray[$p]->value = $this->matrixArray[$i]->value;
            $position[$col]++;
        }
        print ("已转置随机矩阵:\r\n");
        printf("row\tcol\tvalue\r\n");
        for ($k = 1; $k <= count($RevMatrix->matrixArray); ++$k) {
            printf("%d\t%d\t%d", $RevMatrix->matrixArray[$k]->x,$RevMatrix->matrixArray[$k]->y,$RevMatrix->matrixArray[$k]->value);
            print ("\r\n");

        }
    }
}
$d = new Matrix();
$d->InitMatrix();
$d->QuickRevMatrix();




