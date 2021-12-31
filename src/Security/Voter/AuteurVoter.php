<?php

namespace App\Security\Voter;

use App\Entity\User;
use App\Entity\Auteur;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Security;

class AuteurVoter extends Voter
{
const AUTEUR_VIEW = 'auteur_view';
const AUTEUR_EDIT ='auteur_edit';
const AUTEUR_DELETE ='auteur_delete';

private $security;

public function __construct(Security $security)
{
    $this->security = $security;
}

protected function supports(string $attribute, $auteur): bool
{
    
    // replace with your own logic
    // https://symfony.com/doc/current/security/voters.html
    return in_array($attribute, [self::AUTEUR_VIEW , self::AUTEUR_EDIT,  self::AUTEUR_DELETE])
        && $auteur instanceof \App\Entity\Auteur;
}

protected function voteOnAttribute(string $attribute, $auteur, TokenInterface $token): bool
{
    $user = $token->getUser();
    // if the user is anonymous, do not grant access
    if (!$user instanceof UserInterface) {
        return false;
    }

    // on donne tous les droits au super Admin
    if($this->security->isGranted('ROLE_ADMIN')) return true;
    
    // on vérifie si un auteur à un propriétaire user
    if(null === $auteur->getUser()) return false;

    // ... (check conditions and return true to grant permission) ...
    switch ($attribute) {

        case self::AUTEUR_VIEW:
            // logic to determine if the user can EDIT
            return $this->canView($user,$auteur);
            break;

        case self::AUTEUR_EDIT:
            // logic to determine if the user can EDIT
            return $this->canEdit($user,$auteur);
            break;
        case self::AUTEUR_DELETE:
            // logic to determine if the user can VIEW
                // on donne tous les droits au super Admin
            return $this->canDelete($user,$auteur);
            break;
    }

    return false;
}

public function canView(User $user, Auteur $auteur)
{    
    // l'utilisateur user propriètaire voir ses entrées .
    return $user === $auteur->getUser();
}
public function canEdit(User $user , Auteur $auteur) 
{
    // le propriétaire user peut modifier l'annonce
    return  $user === $auteur->getUser();
}

public function canDelete(User $user , Auteur $auteur)
{
    // le propriètaire user peut suprimer l'annonce
    return $user === $auteur->getUser();
}
}
