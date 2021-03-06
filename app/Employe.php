<?php

namespace App;

use App\Traits\EmailAddress\HasEmailAddresses;
use App\Traits\PhoneNum\HasPhoneNums;
use Illuminate\Support\Carbon;

/**
 * Class Employe
 * @package App
 *
 * @property integer $id
 *
 * @property string $uuid
 * @property bool $is_default
 * @property string|null $tags
 * @property integer|null $status_id
 *
 * @property string $nom
 * @property string|null $matricule
 * @property string|null $prenom
 * @property string|null $nom_complet
 * @property string|null $adresse
 * @property string|null $objectguid
 * @property string|null $thumbnailphoto
 *
 * @property integer|null $fonction_employe_id
 * @property integer|null $departement_id
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Employe extends BaseModel
{
    use HasEmailAddresses, HasPhoneNums;
    protected $guarded = [];

    /**
     * Get the employe's full concatenated name.
     * -- Must postfix the word 'Attribute' to the function name
     *
     * @return string
     */
    public function getNomCompletAttribute()
    {
        return "{$this->nom} {$this->prenom}";
    }

    #region Eloquent Relationships

    /**
     * Renvoie la Fonction de l employe.
     */
    public function fonction() {
        return $this->belongsTo('App\FonctionEmploye', 'fonction_employe_id');
    }

    /**
     * Renvoie l Assignation de l employe.
     */
    public function departement() {
        return $this->belongsTo('App\Departement');
    }


    /**
     * Retourne toutes les Departements pour lesquelles cet employe est responsable.
     */
    public function departementsResponsable() {
        return $this->hasMany('App\Departement', 'employe_responsable_id');
    }

    #endregion

    #region Validation Rules

    public static function defaultRules() {
        return [
            'nom' => ['required','string','min:3','max:255',],
            'fonction_employe_id' => ['required','integer',],
        ];
    }
    public static function createRules()  {
        return array_merge(self::defaultRules(), [
            'nouveau_email' => ['required'],
            'nouveau_phone' => ['required'],
            'matricule' => ['required','unique:employes,matricule,NULL,id,deleted_at,NULL',],
        ]);
    }
    public static function updateRules($model) {
        return array_merge(self::defaultRules(), [
            'matricule' => ['required','unique:employes,matricule,'.$model->id.',id,deleted_at,NULL',],
        ]);
    }
    public static function validationMessages() {
        return [];
    }

    #endregion
}
