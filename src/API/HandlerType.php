<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 20.2.18.
 * Time: 17.20
 */

namespace App\API;


abstract class HandlerType
{
    const User = 1;
    const Presence = 2;
    const Project = 3;
    const Etape = 4;
    const Task = 5;
    const Participant = 6;
    const Report = 7;
    const Team = 8;
    const Salary = 9;
    const BusinessClient = 10;
    const Bonus = 11;
    const DaysOff = 12;
    const ProjectType = 13;
    const ParticipantType = 14;
    const UserType = 15;
    const Position = 16;
    const Holiday = 17;
    const ProjectExpense = 18;
    const Currency = 19;
    const Bank = 20;
    const Account = 21;
    const Invoice = 22;
    const Company = 23;
    const InvoiceItem = 24;
}