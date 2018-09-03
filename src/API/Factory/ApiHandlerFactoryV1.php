<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 20.2.18.
 * Time: 17.26
 */

namespace App\API\Factory;


use App\API\HandlerType;
use App\API\V1\AccountHandler;
use App\API\V1\BankHandler;
use App\API\V1\BonusHandler;
use App\API\V1\BusinessClientHandler;
use App\API\V1\CompanyHandler;
use App\API\V1\CurrencyHandler;
use App\API\V1\DaysOffHandler;
use App\API\V1\EtapeHandler;
use App\API\V1\HolidayHandler;
use App\API\V1\InvoiceHandler;
use App\API\V1\ParticipantHandler;
use App\API\V1\ParticipantTypeHandler;
use App\API\V1\PositionHandler;
use App\API\V1\PresenceHandler;
use App\API\V1\ProjectExpenseHandler;
use App\API\V1\ProjectHandler;
use App\API\V1\ProjectTypeHandler;
use App\API\V1\ReportHandler;
use App\API\V1\SalaryHandler;
use App\API\V1\TaskHandler;
use App\API\V1\TeamHandler;
use App\API\V1\UserHandler;
use App\API\V1\UserTypeHandler;

class ApiHandlerFactoryV1
{

    public function getHandler($type, $em, $container, $logger)
    {
        if ($type == HandlerType::User) {
            return new UserHandler($em, $container, $logger);
        }

        if ($type == HandlerType::Presence) {
            return new PresenceHandler($em, $container, $logger);
        }

        if($type == HandlerType::Project)
        {
            return new ProjectHandler( $em, $container, $logger);
        }

        if($type == HandlerType::Etape)
        {
            return new EtapeHandler( $em, $container, $logger);
        }

        if($type == HandlerType::Task) {
            return new TaskHandler($em, $container, $logger);
        }

        if($type == HandlerType::Participant) {
            return new ParticipantHandler($em, $container, $logger);
        }

        if($type == HandlerType::Report) {
            return new ReportHandler($em, $container, $logger);
        }

        if($type == HandlerType::Team) {
            return new TeamHandler($em, $container, $logger);
        }

        if($type == HandlerType::Salary) {
            return new SalaryHandler($em, $container, $logger);
        }

        if($type == HandlerType::BusinessClient) {
            return new BusinessClientHandler($em, $container, $logger);
        }

        if($type == HandlerType::Bonus) {
            return new BonusHandler($em, $container, $logger);
        }

        if($type == HandlerType::DaysOff) {
            return new DaysOffHandler($em, $container, $logger);
        }

        if($type == HandlerType::ProjectType) {
            return new ProjectTypeHandler($em, $container, $logger);
        }

        if($type == HandlerType::ParticipantType) {
            return new ParticipantTypeHandler($em, $container, $logger);
        }

        if($type == HandlerType::UserType) {
            return new UserTypeHandler($em, $container, $logger);
        }

        if($type == HandlerType::Position) {
            return new PositionHandler($em, $container, $logger);
        }

        if($type == HandlerType::Holiday) {
            return new HolidayHandler($em, $container, $logger);
        }

        if($type == HandlerType::ProjectExpense) {
            return new ProjectExpenseHandler($em, $container, $logger);
        }

        if($type == HandlerType::Currency) {
            return new CurrencyHandler($em, $container, $logger);
        }

        if($type == HandlerType::Bank) {
            return new BankHandler($em, $container, $logger);
        }

        if($type == HandlerType::Account) {
            return new AccountHandler($em, $container, $logger);
        }

        if($type == HandlerType::Invoice) {
            return new InvoiceHandler($em, $container, $logger);
        }

        if($type == HandlerType::Company) {
            return new CompanyHandler($em, $container, $logger);
        }

        return null;
    }
}