<?php

namespace dunkel\graphqlsites\gql\queries;

use Craft;
use dunkel\graphqlsites\gql\interfaces\SitesInterface;
use dunkel\graphqlsites\gql\resolvers\SitesResolver;
use dunkel\graphqlsites\helpers\Gql as GqlHelper;
use GraphQL\Type\Definition\Type;

use craft\gql\base\Query;

class SitesQuery extends Query {
	public static function getQueries(bool $checkToken = true): array {
		if ($checkToken && !GqlHelper::canQuerySites()) {
			return [];
		}

		return [
			// c for custom
			'csites' => [
				'type' => Type::listOf(SitesInterface::getType()),
				'args' => [],
				'resolve' => SitesResolver::class . '::resolve',
				'description' => 'This query is used to query for sites data.'
			],
		];
	}
}