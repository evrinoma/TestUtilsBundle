<?php

namespace Evrinoma\TestUtilsBundle\Action;

use Evrinoma\TestUtilsBundle\Browser\InitApiBrowserTestInterface;
use Evrinoma\TestUtilsBundle\Browser\ApiBrowserTestInterface;
use Evrinoma\TestUtilsBundle\Helper\ApiMethodTestInterface;

interface ActionTestInterface extends ApiBrowserTestInterface, InitApiBrowserTestInterface, ApiMethodTestInterface
{
//region SECTION:Public
    public function actionPost(): void;

    public function actionPostDuplicate(): void;

    public function actionPostUnprocessable(): void;

    public function actionCriteria(): void;

    public function actionCriteriaNotFound(): void;

    public function actionPut(): void;

    public function actionPutNotFound(): void;

    public function actionPutUnprocessable(): void;

    public function actionDelete(): void;

    public function actionDeleteNotFound(): void;

    public function actionDeleteUnprocessable(): void;

    public function actionGet(): void;

    public function actionGetNotFound(): void;
//endregion Public
}