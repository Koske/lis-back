<?php
/**
 * Created by PhpStorm.
 * User: dusan
 * Date: 11.6.18.
 * Time: 12.55
 */

namespace App\API\V1;


use App\Entity\Presence;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;

class ReportHandler extends BaseHandler
{

    public function getInitialInfo(Request $request)
    {
        $checkInTimeJan = 0;
        $checkOutTimeJan = 0;
        $checkInTimeFeb = 0;
        $checkOutTimeFeb = 0;
        $checkInTimeMar = 0;
        $checkOutTimeMar = 0;
        $checkInTimeApr = 0;
        $checkOutTimeApr = 0;
        $checkInTimeMay = 0;
        $checkOutTimeMay = 0;
        $checkInTimeJun = 0;
        $checkOutTimeJun = 0;
        $checkInTimeJul = 0;
        $checkOutTimeJul = 0;
        $checkInTimeAug = 0;
        $checkOutTimeAug = 0;
        $checkInTimeSep = 0;
        $checkOutTimeSep = 0;
        $checkInTimeOct = 0;
        $checkOutTimeOct = 0;
        $checkInTimeNov = 0;
        $checkOutTimeNov = 0;
        $checkInTimeDec = 0;
        $checkOutTimeDec = 0;

        $countStartJan = 0;
        $countEndJan = 0;
        $countStartFeb = 0;
        $countEndFeb = 0;
        $countStartMar = 0;
        $countEndMar = 0;
        $countStartApr = 0;
        $countEndApr = 0;
        $countStartMay = 0;
        $countEndMay = 0;
        $countStartJun = 0;
        $countEndJun = 0;
        $countStartJul = 0;
        $countEndJul = 0;
        $countStartAug = 0;
        $countEndAug = 0;
        $countStartSep = 0;
        $countEndSep = 0;
        $countStartOct = 0;
        $countEndOct = 0;
        $countStartNov = 0;
        $countEndNov = 0;
        $countStartDec = 0;
        $countEndDec = 0;
        $timeStart = 0;
        $timeEnd = 0;

        $inJanSend = 0;
        $outJanSend = 0;
        $notFTJan = 0;
        $FTJan = 0;
        $autoCloseJan = 0;

        $inFebSend = 0;
        $outFebSend = 0;
        $notFTFeb = 0;
        $FTFeb = 0;
        $autoCloseFeb = 0;

        $inMarSend = 0;
        $outMarSend = 0;
        $notFTMar = 0;
        $FTMar = 0;
        $autoCloseMar = 0;


        $inAprSend = 0;
        $outAprSend = 0;
        $notFTApr = 0;
        $FTApr = 0;
        $autoCloseApr = 0;


        $inMaySend = 0;
        $outMaySend = 0;
        $notFTMay = 0;
        $FTMay = 0;
        $autoCloseMay = 0;


        $inJunSend = 0;
        $outJunSend = 0;
        $notFTJun = 0;
        $FTJun = 0;
        $autoCloseJun = 0;


        $inJulSend = 0;
        $outJulSend = 0;
        $notFTJul = 0;
        $FTJul = 0;
        $autoCloseJul = 0;


        $inAugSend = 0;
        $outAugSend = 0;
        $notFTAug = 0;
        $FTAug = 0;
        $autoCloseAug = 0;


        $inSepSend = 0;
        $outSepSend = 0;
        $notFTSep = 0;
        $FTSep = 0;
        $autoCloseSep = 0;


        $inOctSend = 0;
        $outOctSend = 0;
        $notFTOct = 0;
        $FTOct = 0;
        $autoCloseOct = 0;


        $inNovSend = 0;
        $outNovSend = 0;
        $notFTNov = 0;
        $FTNov = 0;
        $autoCloseNov = 0;


        $inDecSend = 0;
        $outDecSend = 0;
        $notFTDec = 0;
        $FTDec = 0;
        $autoCloseDec = 0;




        $params = $this->getParams($request);
        $userId = $params->id;
        $year = $params->date;
        $user = $this->em->getRepository(User::class)->find($userId->id);
        $presence = $this->em->getRepository(Presence::class)->findBy(
            [
                'user' => $user,
                'year' => $year
            ]
        );


        foreach ($presence as $i) {
            if ($i->getMonth() == 1) {

                $timeStart = $i->getStart()->format('H:i:s');
                $hourmiliStart = (int)substr($timeStart, 0, 2) * 3600000;
                $minutemiliStart = (int)substr($timeStart, 3, 2) * 60000;
                $secondmiliStart = (int)substr($timeStart, 6, 2) * 1000;
                $countStartJan++;
                $checkInTimeJan += $hourmiliStart + $minutemiliStart + $secondmiliStart;
                $timeEnd = $i->getEnd()->format('H:i:s');
                $hourmiliEnd = (int)substr($timeEnd, 0, 2) * 3600000;
                $minutemiliEnd = (int)substr($timeEnd, 3, 2) * 60000;
                $secondmiliEnd = (int)substr($timeEnd, 6, 2) * 1000;
                $countEndJan++;
                $checkOutTimeJan += $hourmiliEnd + $minutemiliEnd + $secondmiliEnd;
                $start = $hourmiliStart + $minutemiliStart + $secondmiliStart;
                $end = $hourmiliEnd + $minutemiliEnd + $secondmiliEnd;

                if($this->isLessEightHours($start, $end)){
                    $notFTJan++;
                }else{
                    $FTJan++;
                }

                $autoCloseJan += $this->isAutoClosed($i);

            }
            if ($i->getMonth() == 2) {

                $timeStart = $i->getStart()->format('H:i:s');
                $hourmiliStart = (int)substr($timeStart, 0, 2) * 3600000;
                $minutemiliStart = (int)substr($timeStart, 3, 2) * 60000;
                $secondmiliStart = (int)substr($timeStart, 6, 2) * 1000;
                $countStartFeb++;
                $checkInTimeFeb += $hourmiliStart + $minutemiliStart + $secondmiliStart;

                $timeEnd = $i->getEnd()->format('H:i:s');
                $hourmiliEnd = (int)substr($timeEnd, 0, 2) * 3600000;
                $minutemiliEnd = (int)substr($timeEnd, 3, 2) * 60000;
                $secondmiliEnd = (int)substr($timeEnd, 6, 2) * 1000;
                $countEndFeb++;
                $checkOutTimeFeb += $hourmiliEnd + $minutemiliEnd + $secondmiliEnd;
                $start = $hourmiliStart + $minutemiliStart + $secondmiliStart;
                $end = $hourmiliEnd + $minutemiliEnd + $secondmiliEnd;

                if($this->isLessEightHours($start, $end)){
                    $notFTFeb++;
                }else{
                    $FTFeb++;
                }

                $autoCloseFeb += $this->isAutoClosed($i);




            }
            if ($i->getMonth() == 3) {

                $timeStart = $i->getStart()->format('H:i:s');
                $hourmiliStart = (int)substr($timeStart, 0, 2) * 3600000;
                $minutemiliStart = (int)substr($timeStart, 3, 2) * 60000;
                $secondmiliStart = (int)substr($timeStart, 6, 2) * 1000;
                $countStartMar++;
                $checkInTimeMar += $hourmiliStart + $minutemiliStart + $secondmiliStart;

                $timeEnd = $i->getEnd()->format('H:i:s');
                $hourmiliEnd = (int)substr($timeEnd, 0, 2) * 3600000;
                $minutemiliEnd = (int)substr($timeEnd, 3, 2) * 60000;
                $secondmiliEnd = (int)substr($timeEnd, 6, 2) * 1000;
                $countEndMar++;
                $checkOutTimeMar += $hourmiliEnd + $minutemiliEnd + $secondmiliEnd;
                $start = $hourmiliStart + $minutemiliStart + $secondmiliStart;
                $end = $hourmiliEnd + $minutemiliEnd + $secondmiliEnd;

                if($this->isLessEightHours($start, $end)){
                    $notFTMar++;
                }else{
                    $FTMar++;
                }

                $autoCloseMar += $this->isAutoClosed($i);


            }
            if ($i->getMonth() == 4) {

                $timeStart = $i->getStart()->format('H:i:s');
                $hourmiliStart = (int)substr($timeStart, 0, 2) * 3600000;
                $minutemiliStart = (int)substr($timeStart, 3, 2) * 60000;
                $secondmiliStart = (int)substr($timeStart, 6, 2) * 1000;
                $countStartApr++;
                $checkInTimeApr += $hourmiliStart + $minutemiliStart + $secondmiliStart;

                $timeEnd = $i->getEnd()->format('H:i:s');
                $hourmiliEnd = (int)substr($timeEnd, 0, 2) * 3600000;
                $minutemiliEnd = (int)substr($timeEnd, 3, 2) * 60000;
                $secondmiliEnd = (int)substr($timeEnd, 6, 2) * 1000;
                $countEndApr++;
                $checkOutTimeApr += $hourmiliEnd + $minutemiliEnd + $secondmiliEnd;
                $start = $hourmiliStart + $minutemiliStart + $secondmiliStart;
                $end = $hourmiliEnd + $minutemiliEnd + $secondmiliEnd;

                if($this->isLessEightHours($start, $end)){
                    $notFTApr++;
                }else{
                    $FTApr++;
                }
                $autoCloseApr += $this->isAutoClosed($i);


            }
            if ($i->getMonth() == 5) {

                $timeStart = $i->getStart()->format('H:i:s');
                $hourmiliStart = (int)substr($timeStart, 0, 2) * 3600000;
                $minutemiliStart = (int)substr($timeStart, 3, 2) * 60000;
                $secondmiliStart = (int)substr($timeStart, 6, 2) * 1000;
                $countStartMay++;
                $checkInTimeMay += $hourmiliStart + $minutemiliStart + $secondmiliStart;

                $timeEnd = $i->getEnd()->format('H:i:s');
                $hourmiliEnd = (int)substr($timeEnd, 0, 2) * 3600000;
                $minutemiliEnd = (int)substr($timeEnd, 3, 2) * 60000;
                $secondmiliEnd = (int)substr($timeEnd, 6, 2) * 1000;
                $countEndMay++;
                $checkOutTimeMay += $hourmiliEnd + $minutemiliEnd + $secondmiliEnd;
                $start = $hourmiliStart + $minutemiliStart + $secondmiliStart;
                $end = $hourmiliEnd + $minutemiliEnd + $secondmiliEnd;

                if($this->isLessEightHours($start, $end)){
                    $notFTMay++;
                }else{
                    $FTMay++;
                }

                $autoCloseMay += $this->isAutoClosed($i);


            }
            if ($i->getMonth() == 6) {

                $timeStart = $i->getStart()->format('H:i:s');
                $hourmiliStart = (int)substr($timeStart, 0, 2) * 3600000;
                $minutemiliStart = (int)substr($timeStart, 3, 2) * 60000;
                $secondmiliStart = (int)substr($timeStart, 6, 2) * 1000;
                $countStartJun++;
                $checkInTimeJun += $hourmiliStart + $minutemiliStart + $secondmiliStart;

                $timeEnd = $i->getEnd()->format('H:i:s');
                $hourmiliEnd = (int)substr($timeEnd, 0, 2) * 3600000;
                $minutemiliEnd = (int)substr($timeEnd, 3, 2) * 60000;
                $secondmiliEnd = (int)substr($timeEnd, 6, 2) * 1000;
                $countEndJun++;
                $checkOutTimeJun += $hourmiliEnd + $minutemiliEnd + $secondmiliEnd;
                $start = $hourmiliStart + $minutemiliStart + $secondmiliStart;
                $end = $hourmiliEnd + $minutemiliEnd + $secondmiliEnd;

                if($this->isLessEightHours($start, $end)){
                    $notFTJun++;
                }else{
                    $FTJun++;
                }

                $autoCloseJun += $this->isAutoClosed($i);


            }
            if ($i->getMonth() == 7) {

                $timeStart = $i->getStart()->format('H:i:s');
                $hourmiliStart = (int)substr($timeStart, 0, 2) * 3600000;
                $minutemiliStart = (int)substr($timeStart, 3, 2) * 60000;
                $secondmiliStart = (int)substr($timeStart, 6, 2) * 1000;
                $countStartJul++;
                $checkInTimeJul += $hourmiliStart + $minutemiliStart + $secondmiliStart;

                $timeEnd = $i->getEnd()->format('H:i:s');
                $hourmiliEnd = (int)substr($timeEnd, 0, 2) * 3600000;
                $minutemiliEnd = (int)substr($timeEnd, 3, 2) * 60000;
                $secondmiliEnd = (int)substr($timeEnd, 6, 2) * 1000;
                $countEndJul++;
                $checkOutTimeJul += $hourmiliEnd + $minutemiliEnd + $secondmiliEnd;
                $start = $hourmiliStart + $minutemiliStart + $secondmiliStart;
                $end = $hourmiliEnd + $minutemiliEnd + $secondmiliEnd;

                if($this->isLessEightHours($start, $end)){
                    $notFTJul++;
                }else{
                    $FTJul++;
                }

                $autoCloseJul += $this->isAutoClosed($i);


            }
            if ($i->getMonth() == 8) {

                $timeStart = $i->getStart()->format('H:i:s');
                $hourmiliStart = (int)substr($timeStart, 0, 2) * 3600000;
                $minutemiliStart = (int)substr($timeStart, 3, 2) * 60000;
                $secondmiliStart = (int)substr($timeStart, 6, 2) * 1000;
                $countStartAug++;
                $checkInTimeAug += $hourmiliStart + $minutemiliStart + $secondmiliStart;

                $timeEnd = $i->getEnd()->format('H:i:s');
                $hourmiliEnd = (int)substr($timeEnd, 0, 2) * 3600000;
                $minutemiliEnd = (int)substr($timeEnd, 3, 2) * 60000;
                $secondmiliEnd = (int)substr($timeEnd, 6, 2) * 1000;
                $countEndAug++;
                $checkOutTimeAug += $hourmiliEnd + $minutemiliEnd + $secondmiliEnd;
                $start = $hourmiliStart + $minutemiliStart + $secondmiliStart;
                $end = $hourmiliEnd + $minutemiliEnd + $secondmiliEnd;

                if($this->isLessEightHours($start, $end)){
                    $notFTAug++;
                }else{
                    $FTAug++;
                }

                $autoCloseAug += $this->isAutoClosed($i);


            }
            if ($i->getMonth() == 9) {

                $timeStart = $i->getStart()->format('H:i:s');
                $hourmiliStart = (int)substr($timeStart, 0, 2) * 3600000;
                $minutemiliStart = (int)substr($timeStart, 3, 2) * 60000;
                $secondmiliStart = (int)substr($timeStart, 6, 2) * 1000;
                $countStartSep++;
                $checkInTimeSep += $hourmiliStart + $minutemiliStart + $secondmiliStart;

                $timeEnd = $i->getEnd()->format('H:i:s');
                $hourmiliEnd = (int)substr($timeEnd, 0, 2) * 3600000;
                $minutemiliEnd = (int)substr($timeEnd, 3, 2) * 60000;
                $secondmiliEnd = (int)substr($timeEnd, 6, 2) * 1000;
                $countEndSep++;
                $checkOutTimeSep += $hourmiliEnd + $minutemiliEnd + $secondmiliEnd;
                $start = $hourmiliStart + $minutemiliStart + $secondmiliStart;
                $end = $hourmiliEnd + $minutemiliEnd + $secondmiliEnd;

                if($this->isLessEightHours($start, $end)){
                    $notFTSep++;
                }else{
                    $FTSep++;
                }

                $autoCloseSep += $this->isAutoClosed($i);


            }
            if ($i->getMonth() == 10) {

                $timeStart = $i->getStart()->format('H:i:s');
                $hourmiliStart = (int)substr($timeStart, 0, 2) * 3600000;
                $minutemiliStart = (int)substr($timeStart, 3, 2) * 60000;
                $secondmiliStart = (int)substr($timeStart, 6, 2) * 1000;
                $countStartOct++;
                $checkInTimeOct += $hourmiliStart + $minutemiliStart + $secondmiliStart;

                $timeEnd = $i->getEnd()->format('H:i:s');
                $hourmiliEnd = (int)substr($timeEnd, 0, 2) * 3600000;
                $minutemiliEnd = (int)substr($timeEnd, 3, 2) * 60000;
                $secondmiliEnd = (int)substr($timeEnd, 6, 2) * 1000;
                $countEndOct++;
                $checkOutTimeOct += $hourmiliEnd + $minutemiliEnd + $secondmiliEnd;
                $start = $hourmiliStart + $minutemiliStart + $secondmiliStart;
                $end = $hourmiliEnd + $minutemiliEnd + $secondmiliEnd;

                if($this->isLessEightHours($start, $end)){
                    $notFTOct++;
                }else{
                    $FTOct++;
                }

                $autoCloseOct += $this->isAutoClosed($i);


            }
            if ($i->getMonth() == 11) {

                $timeStart = $i->getStart()->format('H:i:s');
                $hourmiliStart = (int)substr($timeStart, 0, 2) * 3600000;
                $minutemiliStart = (int)substr($timeStart, 3, 2) * 60000;
                $secondmiliStart = (int)substr($timeStart, 6, 2) * 1000;
                $countStartNov++;
                $checkInTimeNov += $hourmiliStart + $minutemiliStart + $secondmiliStart;

                $timeEnd = $i->getEnd()->format('H:i:s');
                $hourmiliEnd = (int)substr($timeEnd, 0, 2) * 3600000;
                $minutemiliEnd = (int)substr($timeEnd, 3, 2) * 60000;
                $secondmiliEnd = (int)substr($timeEnd, 6, 2) * 1000;
                $countEndNov++;
                $checkOutTimeNov += $hourmiliEnd + $minutemiliEnd + $secondmiliEnd;
                $start = $hourmiliStart + $minutemiliStart + $secondmiliStart;
                $end = $hourmiliEnd + $minutemiliEnd + $secondmiliEnd;

                if($this->isLessEightHours($start, $end)){
                    $notFTNov++;
                }else{
                    $FTNov++;
                }

                $autoCloseNov += $this->isAutoClosed($i);


            }
            if ($i->getMonth() == 12) {

                $timeStart = $i->getStart()->format('H:i:s');
                $hourmiliStart = (int)substr($timeStart, 0, 2) * 3600000;
                $minutemiliStart = (int)substr($timeStart, 3, 2) * 60000;
                $secondmiliStart = (int)substr($timeStart, 6, 2) * 1000;
                $countStartDec++;
                $checkInTimeDec += $hourmiliStart + $minutemiliStart + $secondmiliStart;

                $timeEnd = $i->getEnd()->format('H:i:s');
                $hourmiliEnd = (int)substr($timeEnd, 0, 2) * 3600000;
                $minutemiliEnd = (int)substr($timeEnd, 3, 2) * 60000;
                $secondmiliEnd = (int)substr($timeEnd, 6, 2) * 1000;
                $countEndDec++;
                $checkOutTimeDec += $hourmiliEnd + $minutemiliEnd + $secondmiliEnd;
                $start = $hourmiliStart + $minutemiliStart + $secondmiliStart;
                $end = $hourmiliEnd + $minutemiliEnd + $secondmiliEnd;

                if($this->isLessEightHours($start, $end)){
                    $notFTDec++;
                }else{
                    $FTDec++;
                }

                $autoCloseDec += $this->isAutoClosed($i);


            }

        }
        if ($countStartJan != 0 && $countEndJan != 0) {
            //jan
            $checkInTimeJan = $checkInTimeJan / $countStartJan;
            $hoursInJan = (($checkInTimeJan / (1000 * 60 * 60)) % 24);
            $minutesInJan = (($checkInTimeJan / (1000 * 60)) % 60);
            $secondsInJan = ($checkInTimeJan / 1000) % 60;

            $inJanSend = $hoursInJan . ":" . $minutesInJan . ':' . $secondsInJan;


            $checkOutTimeJan = $checkOutTimeJan / $countStartJan;
            $hoursOutJan = (($checkOutTimeJan / (1000 * 60 * 60)) % 24);
            $minutesOutJan = (($checkOutTimeJan / (1000 * 60)) % 60);
            $secondsOutJan = ($checkOutTimeJan / 1000) % 60;

            $outJanSend = $hoursOutJan . ":" . $minutesOutJan . ':' . $secondsOutJan;
        }
        if ($countStartFeb != 0 && $countEndFeb != 0) {

            //feb

            $checkInTimeFeb = $checkInTimeFeb / $countStartFeb;
            $hoursInFeb = (($checkInTimeFeb / (1000 * 60 * 60)) % 24);
            $minutesInFeb = (($checkInTimeFeb / (1000 * 60)) % 60);
            $secondsInFeb = ($checkInTimeFeb / 1000) % 60;

            $inFebSend = $hoursInFeb . ":" . $minutesInFeb . ':' . $secondsInFeb;

            $checkOutTimeFeb = $checkOutTimeFeb / $countStartFeb;
            $hoursOutFeb = (($checkOutTimeFeb / (1000 * 60 * 60)) % 24);
            $minutesOutFeb = (($checkOutTimeFeb / (1000 * 60)) % 60);
            $secondsOutFeb = ($checkOutTimeFeb / 1000) % 60;

            $outFebSend = $hoursOutFeb . ":" . $minutesOutFeb . ':' . $secondsOutFeb;
        }
        if ($countStartMay != 0 && $countEndMay != 0) {


            //may
            $checkInTimeMay = $checkInTimeMay / $countStartMay;
            $hoursInMay = (($checkInTimeMay / (1000 * 60 * 60)) % 24);
            $minutesInMay = (($checkInTimeMay / (1000 * 60)) % 60);
            $secondsInMay = ($checkInTimeMay / 1000) % 60;

            $inMaySend = $hoursInMay . ":" . $minutesInMay . ':' . $secondsInMay;

            $checkOutTimeMay = $checkOutTimeMay / $countStartMay;
            $hoursOutMay = (($checkOutTimeMay / (1000 * 60 * 60)) % 24);
            $minutesOutMay = (($checkOutTimeMay / (1000 * 60)) % 60);
            $secondsOutMay = ($checkOutTimeMay / 1000) % 60;

            $outMaySend = $hoursOutMay . ":" . $minutesOutMay . ':' . $secondsOutMay;
        }

        if ($countStartMar != 0 && $countEndMar != 0) {

            //mar
            $checkInTimeMar = $checkInTimeMar / $countStartMar;
            $hoursInMar = (($checkInTimeMar / (1000 * 60 * 60)) % 24);
            $minutesInMar = (($checkInTimeMar / (1000 * 60)) % 60);
            $secondsInMar = ($checkInTimeMar / 1000) % 60;

            $inMarSend = $hoursInMar . ":" . $minutesInMar . ':' . $secondsInMar;

            $checkOutTimeMar = $checkOutTimeMar / $countStartMar;
            $hoursOutMar = (($checkOutTimeMar / (1000 * 60 * 60)) % 24);
            $minutesOutMar = (($checkOutTimeMar / (1000 * 60)) % 60);
            $secondsOutMar = ($checkOutTimeMar / 1000) % 60;

            $outMarSend = $hoursOutMar . ":" . $minutesOutMar . ':' . $secondsOutMar;
        }
        if ($countStartApr != 0 && $countEndApr != 0) {
            //april

            $checkInTimeApr = $checkInTimeApr / $countStartApr;
            $hoursInApr = (($checkInTimeApr / (1000 * 60 * 60)) % 24);
            $minutesInApr = (($checkInTimeApr / (1000 * 60)) % 60);
            $secondsInApr = ($checkInTimeApr / 1000) % 60;

            $inAprSend = $hoursInApr . ":" . $minutesInApr . ':' . $secondsInApr;

            $checkOutTimeApr = $checkOutTimeApr / $countStartApr;
            $hoursOutApr = (($checkOutTimeApr / (1000 * 60 * 60)) % 24);
            $minutesOutApr = (($checkOutTimeApr / (1000 * 60)) % 60);
            $secondsOutApr = ($checkOutTimeApr / 1000) % 60;

            $outAprSend = $hoursOutApr . ":" . $minutesOutApr . ':' . $secondsOutApr;
        }
        //june

        if ($countStartJun != 0 && $countEndJun != 0) {


        $checkInTimeJun = $checkInTimeJun / $countStartJun;
        $hoursInJun = (($checkInTimeJun / (1000 * 60 * 60)) % 24);
        $minutesInJun = (($checkInTimeJun / (1000 * 60)) % 60);
        $secondsInJun = ($checkInTimeJun / 1000) % 60;

        $inJunSend = $hoursInJun . ":" . $minutesInJun . ':' . $secondsInJun;

        $checkOutTimeJun = $checkOutTimeJun / $countStartJun;
        $hoursOutJun = (($checkOutTimeJun / (1000 * 60 * 60)) % 24);
        $minutesOutJun = (($checkOutTimeJun / (1000 * 60)) % 60);
        $secondsOutJun = ($checkOutTimeJun / 1000) % 60;

        $outJunSend = $hoursOutJun . ":" . $minutesOutJun . ':' . $secondsOutJun;
    }

        if($countStartJul!=0 && $countEndJul!=0) {
            //July

            $checkInTimeJul = $checkInTimeJul / $countStartJul;
            $hoursInJul = (($checkInTimeJul / (1000 * 60 * 60)) % 24);
            $minutesInJul = (($checkInTimeJul / (1000 * 60)) % 60);
            $secondsInJul = ($checkInTimeJul / 1000) % 60;

            $inJulSend = $hoursInJul . ":" . $minutesInJul . ':' . $secondsInJul;

            $checkOutTimeJul = $checkOutTimeJul / $countStartJul;
            $hoursOutJul = (($checkOutTimeJul / (1000 * 60 * 60)) % 24);
            $minutesOutJul = (($checkOutTimeJul / (1000 * 60)) % 60);
            $secondsOutJul = ($checkOutTimeJul / 1000) % 60;

            $outJulSend = $hoursOutJul . ":" . $minutesOutJul . ':' . $secondsOutJul;
        }
            // August
        if($countStartAug!=0 && $countEndAug!=0) {


            $checkInTimeAug = $checkInTimeAug / $countStartAug;
            $hoursInAug = (($checkInTimeAug / (1000 * 60 * 60)) % 24);
            $minutesInAug = (($checkInTimeAug / (1000 * 60)) % 60);
            $secondsInAug = ($checkInTimeAug / 1000) % 60;

            $inAugSend = $hoursInAug . ":" . $minutesInAug . ':' . $secondsInAug;

            $checkOutTimeAug = $checkOutTimeAug / $countStartAug;
            $hoursOutAug = (($checkOutTimeAug / (1000 * 60 * 60)) % 24);
            $minutesOutAug = (($checkOutTimeAug / (1000 * 60)) % 60);
            $secondsOutAug = ($checkOutTimeAug / 1000) % 60;

            $outAugSend = $hoursOutAug . ":" . $minutesOutAug . ':' . $secondsOutAug;
        }
            // September
        if($countStartSep!=0 && $countEndSep!=0) {


            $checkInTimeSep = $checkInTimeSep / $countStartSep;
            $hoursInSep = (($checkInTimeSep / (1000 * 60 * 60)) % 24);
            $minutesInSep = (($checkInTimeSep / (1000 * 60)) % 60);
            $secondsInSep = ($checkInTimeSep / 1000) % 60;

            $inSepSend = $hoursInSep . ":" . $minutesInSep . ':' . $secondsInSep;

            $checkOutTimeSep = $checkOutTimeSep / $countStartSep;
            $hoursOutSep = (($checkOutTimeSep / (1000 * 60 * 60)) % 24);
            $minutesOutSep = (($checkOutTimeSep / (1000 * 60)) % 60);
            $secondsOutSep = ($checkOutTimeSep / 1000) % 60;

            $outSepSend = $hoursOutSep . ":" . $minutesOutSep . ':' . $secondsOutSep;
        }
            // October
        if($countStartOct!=0 && $countEndOct!=0) {

            $checkInTimeOct = $checkInTimeOct / $countStartOct;
            $hoursInOct = (($checkInTimeOct / (1000 * 60 * 60)) % 24);
            $minutesInOct = (($checkInTimeOct / (1000 * 60)) % 60);
            $secondsInOct = ($checkInTimeOct / 1000) % 60;

            $inOctSend = $hoursInOct . ":" . $minutesInOct . ':' . $secondsInOct;

            $checkOutTimOct = $checkOutTimeOct / $countStartOct;
            $hoursOutOct = (($checkOutTimeOct / (1000 * 60 * 60)) % 24);
            $minutesOutOct = (($checkOutTimeOct / (1000 * 60)) % 60);
            $secondsOutOct = ($checkOutTimeOct / 1000) % 60;

            $outOctSend = $hoursOutOct . ":" . $minutesOutOct . ':' . $secondsOutOct;
        }

        if($countStartNov!=0 && $countEndNov!=0) {
            // November

            $checkInTimeNov = $checkInTimeNov / $countStartNov;
            $hoursInNov = (($checkInTimeNov / (1000 * 60 * 60)) % 24);
            $minutesInNov = (($checkInTimeNov / (1000 * 60)) % 60);
            $secondsInNov = ($checkInTimeNov / 1000) % 60;

            $inNovSend = $hoursInNov . ":" . $minutesInNov . ':' . $secondsInNov;

            $checkOutTimeNov = $checkOutTimeNov / $countStartNov;
            $hoursOutNov = (($checkOutTimeNov / (1000 * 60 * 60)) % 24);
            $minutesOutNov = (($checkOutTimeNov / (1000 * 60)) % 60);
            $secondsOutNov = ($checkOutTimeNov / 1000) % 60;

            $outNovSend = $hoursOutNov . ":" . $minutesOutNov . ':' . $secondsOutNov;

        }

        if($countStartDec!=0 && $countEndDec!=0) {

            //December

            $checkInTimeDec = $checkInTimeDec / $countStartDec;
            $hoursInDec = (($checkInTimeDec / (1000 * 60 * 60)) % 24);
            $minutesInDec = (($checkInTimeDec / (1000 * 60)) % 60);
            $secondsInDec = ($checkInTimeDec / 1000) % 60;

            $inDecSend = $hoursInDec . ":" . $minutesInDec . ':' . $secondsInDec;

            $checkOutTimeDec = $checkOutTimeDec / $countStartDec;
            $hoursOutDec = (($checkOutTimeDec / (1000 * 60 * 60)) % 24);
            $minutesOutDec = (($checkOutTimeDec / (1000 * 60)) % 60);
            $secondsOutDec = ($checkOutTimeDec / 1000) % 60;

            $outDecSend = $hoursOutDec . ":" . $minutesOutDec . ':' . $secondsOutDec;

        }

        $january = [];
        $february = [];
        $march = [];
        $april = [];
        $may = [];
        $june = [];
        $july = [];
        $august = [];
        $september = [];
        $october = [];
        $november = [];
        $december = [];
        $months = [];




        array_push($months,
            ['name'=>'January','inSend'=> $inJanSend,'outSend'=> $outJanSend,
            'notFT'=>$notFTJan,'FT'=> $FTJan,'autoClose'=> $autoCloseJan],
            ['name'=>'February','inSend'=>$inFebSend, 'outSend'=>$outFebSend,
                'notFT'=>$notFTFeb,'FT'=> $FTFeb,'autoClose'=> $autoCloseFeb],
            ['name'=> 'March','inSend'=>$inMarSend,'outSend'=> $outMarSend,
                'notFT'=>$notFTMar,'FT'=>  $FTMar,'autoClose'=> $autoCloseMar],
            ['name'=> 'April','inSend'=> $inAprSend,'outSend'=> $outAprSend,
                'notFT'=>$notFTApr,'FT'=> $FTApr,'autoClose'=> $autoCloseApr],
            ['name'=>  'May','inSend'=>$inMaySend,'outSend'=> $outMaySend,
                'notFT'=>$notFTMay,'FT'=> $FTMay,'autoClose'=> $autoCloseMay],
            ['name'=> 'June','inSend'=>$inJunSend,'outSend'=> $outJunSend,
                'notFT'=>$notFTJun,'FT'=> $FTJun,'autoClose'=> $autoCloseJun],
            ['name'=> 'July','inSend'=>$inJulSend,'outSend'=> $outJulSend,
                'notFT'=>$notFTJul, 'FT'=>$FTJul, 'autoClose'=>$autoCloseJul],
            ['name'=>  'August','inSend'=>$inAugSend,'outSend'=> $outAugSend,
                'notFT'=>$notFTAug, 'FT'=>$FTAug,'autoClose'=> $autoCloseAug],
            ['name'=>  'September','inSend'=>$inSepSend,'outSend'=> $outSepSend,
                'notFT'=>$notFTSep, 'FT'=>$FTSep, 'autoClose'=>$autoCloseSep],
            ['name'=>  'October','inSend'=>$inOctSend,'outSend'=> $outOctSend,
                'notFT'=>$notFTOct,'FT'=> $FTOct,'autoClose'=> $autoCloseOct],
            ['name'=>  'November','inSend'=>$inNovSend,'outSend'=> $outNovSend,
                'notFT'=>$notFTNov,'FT'=> $FTNov,'autoClose'=> $autoCloseNov],
            ['name'=> 'December','inSend'=>$inDecSend,'outSend'=> $outDecSend,
                'notFT'=>$notFTDec, 'FT'=>$FTDec,'autoClose'=> $autoCloseDec]
        );








        return $this->getResponse([
            'user' => $user,
            'presence' => $presence,

            'months' => $months
        ]);
    }

    public function getInfoForMonth(Request $request){
        $params = $this->getParams($request);
        $userId = $params->id->id;
        $year = $params->date;
        $month = $params->month;
        $user = $this->em->getRepository(User::class)->find($userId);

        $presence = $this->em->getRepository(Presence::class)->findBy(
            [
                'user' => $user,
                'year' => $year,
                'month' => $month
            ]
        );

        return $this->getResponse([
            'presence' => $presence
        ]);

    }

    function isWeekend($date) {
        return (date('N', strtotime($date)) >= 6);
    }

    function isLessEightHours($start, $end){
        if($end-$start<28800000){
            return true;
        }else {
            return false;
        }
    }

    function isAutoClosed(Presence $presence){
        if($presence->getAutoClosed()){
            return 1;
        }else{
            return 0;
        }
    }




}