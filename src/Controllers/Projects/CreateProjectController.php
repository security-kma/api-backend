<?php

declare(strict_types=1);

namespace Reconmap\Controllers\Projects;

use Psr\Http\Message\ServerRequestInterface;
use Reconmap\Controllers\Controller;
use Reconmap\Repositories\ProjectRepository;

class CreateProjectController extends Controller
{

    public function __invoke(ServerRequestInterface $request, array $args): array
    {
        $project = $this->getJsonBodyDecoded($request);
        $project->isTemplate = false;

        $repository = new ProjectRepository($this->db);
        $result = $repository->insert($project);

        return ['success' => $result];
    }
}
