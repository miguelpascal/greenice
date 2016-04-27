<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ListContacts;

/**
 * ListContactsSearch represents the model behind the search form about `common\models\ListContacts`.
 */
class ListContactsSearch extends ListContacts
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_list', 'id_createur', 'id_supp'], 'integer'],
            [['nom', 'type', 'date_creation'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ListContacts::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_list' => $this->id_list,
            'id_createur' => $this->id_createur,
            'id_supp' => $this->id_supp,
            'date_creation' => $this->date_creation,
        ]);

        $query->andFilterWhere(['like', 'nom', $this->nom])
            ->andFilterWhere(['like', 'type', $this->type]);

        return $dataProvider;
    }
}
