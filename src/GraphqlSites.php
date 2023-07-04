<?php

namespace dunkel\graphqlsites;

use Craft;
use yii\base\Event;
use craft\base\Model;
use craft\base\Plugin;
use craft\events\RegisterGqlQueriesEvent;
use craft\events\RegisterGqlSchemaComponentsEvent;
use craft\services\Gql;
use dunkel\graphqlsites\models\Settings;
use dunkel\graphqlsites\gql\queries\SitesQuery;


/**
 * craft-graphql-sites plugin
 *
 * @method static GraphqlSites getInstance()
 * @method Settings getSettings()
 */
class GraphqlSites extends Plugin
{
	public string $schemaVersion = '1.0.0';

	public function init() {
		parent::init();

		$gqlService = Craft::$app->getGql();
		$gqlService->flushCaches();

		Event::on(
			Gql::class,
			Gql::EVENT_REGISTER_GQL_QUERIES,
			function(RegisterGqlQueriesEvent $event) {
				$event->queries = array_merge(
					$event->queries,
					SitesQuery::getQueries()
				);
			}
		);

		Event::on(
			Gql::class,
			Gql::EVENT_REGISTER_GQL_SCHEMA_COMPONENTS,
			static function (RegisterGqlSchemaComponentsEvent $event) {
				$event->queries['GraphQL Sites']['graphqlsites.all:read'] = ['label' => 'Allow to list sites'];
			}
		);
	}

	protected function createSettingsModel(): ?Model {
		return Craft::createObject(Settings::class);
	}
}