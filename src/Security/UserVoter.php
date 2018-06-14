<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 30.3.18.
 * Time: 15.06
 */

namespace App\Security;

use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class UserVoter extends Voter
{
    const EDIT = 'edit';

    private $decisionManager;

    public function __construct(AccessDecisionManagerInterface $decisionManager)
    {
        $this->decisionManager = $decisionManager;
    }

    protected function supports($attribute, $subject)
    {
        if (!in_array($attribute, array(self::EDIT))) {
            return false;
        }

        if (!$subject instanceof User) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            return false;
        }

        switch ($attribute) {
            case self::EDIT: return $this->canEdit($subject, $user, $token);
        }
    }

    private function canEdit(User $user, User $loggedUser, $token)
    {
        if (!$this->decisionManager->decide($token, array('IS_AUTHENTICATED_FULLY'))) {
            return false;
        }

        return $user === $loggedUser;
    }
}