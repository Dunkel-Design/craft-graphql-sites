<?php

namespace dunkel\graphqlsites\gql\queries;

use Craft;
use dunkel\graphqlsites\gql\resolvers\SitesResolver;
use dunkel\graphqlsites\helpers\Gql as GqlHelper;
use GraphQL\Type\Definition\{Type, ObjectType};
use craft\gql\GqlEntityRegistry;

use craft\gql\base\Query;

class SitesQuery extends Query {
	public static function getQueries(bool $checkToken = true): array {
		if ($checkToken && !GqlHelper::canQuerySites()) {
			return [];
		}

		return [
			// c for custom
			'csites' => [
				'type' => Type::listOf(GqlEntityRegistry::getEntity('CSite')),
				'args' => [],
				'resolve' => SitesResolver::class . '::resolve',
				'description' => 'This query is used to query for sites data.'
			],
		];
	}

	static function getSiteType() {
		return new ObjectType([
			'name' => 'CSite',
			'fields' => [
				'id' => Type::int(),
				'baseUrl' => Type::string(),
				'language' => Type::string()
			]
		]);
	}
}