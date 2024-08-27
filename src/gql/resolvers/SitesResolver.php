<?php

namespace dunkel\graphqlsites\gql\resolvers;

use Craft;
use craft\gql\base\Resolver;

use GraphQL\Type\Definition\ResolveInfo;

class SitesResolver extends Resolver
{
	public static function resolve(
		mixed $source,
		array $arguments,
		mixed $context,
		ResolveInfo $resolveInfo
	): mixed {
		$sites = [];

		foreach (Craft::$app->sites->allSites as $site) {
			$sites[] = [
				"id" => $site->id,
				"baseUrl" => $site->baseUrl,
				"language" => $site->language,
			];
		}

		return $sites;
	}
}
