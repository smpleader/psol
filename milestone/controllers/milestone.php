<?php namespace App\psol\milestone\controllers;

use SPT\Web\ControllerMVVM;
use SPT\Response;

class milestone extends ControllerMVVM
{
    public function detail()
    {
        
        $urlVars = $this->request->get('urlVars');
        $id = (int) $urlVars['id'];

        $exist = $this->MilestoneEntity->findByPK($id);
        if (!empty($id) && !$exist) {
            $this->session->set('flashMsg', "Invalid Milestone");
            return $this->app->redirect(
                $this->router->url('milestones')
            );
        }

        $this->app->set('layout', 'backend.milestone.form');
        $this->app->set('page', 'backend');
        $this->app->set('format', 'html');
    }

    public function list()
    {
        
        $this->app->set('page', 'backend');
        $this->app->set('format', 'html');
        $this->app->set('layout', 'backend.milestone.list');
        return ;
    }

    public function add()
    {
        //check title sprint
        $data = [
            'title' => $this->request->post->get('title', '', 'string'),
            'description' => $this->request->post->get('description', '', 'string'),
            'start_date' => $this->request->post->get('start_date', '', 'string'),
            'end_date' => $this->request->post->get('end_date', '', 'string'),
            'status' => $this->request->post->get('status', ''),
            'created_by' => $this->user->get('id'),
            'created_at' => date('Y-m-d H:i:s'),
            'modified_by' => $this->user->get('id'),
            'modified_at' => date('Y-m-d H:i:s')
        ];

        $try = $this->MilestoneModel->add($data);
        $msg = $try ? 'Create Successfully!' : 'Error: '. $this->MilestoneModel->getError();
        $this->session->set('flashMsg', $msg);
        return $this->app->redirect(
            $this->router->url('milestones')
        );
    }

    public function update()
    {

        $ids = $this->validateID();

        if (is_array($ids) && $ids != null) {
            // publishment
            $count = 0;
            $action = $this->request->post->get('status', 0, 'string');

            foreach ($ids as $id) {
                $toggle = $this->MilestoneEntity->toggleStatus($id, $action);
                $count++;
            }
            $this->session->set('flashMsg', $count . ' changed record(s)');
            return $this->app->redirect(
                $this->router->url('milestones')
            );
        }
        if (is_numeric($ids) && $ids) {
            $data = [
                'title' => $this->request->post->get('title', '', 'string'),
                'description' => $this->request->post->get('description', '', 'string'),
                'start_date' => $this->request->post->get('start_date', '', 'string'),
                'end_date' => $this->request->post->get('end_date', '', 'string'),
                'status' => $this->request->post->get('status', ''),
                'id' => $ids,
                'modified_by' => $this->user->get('id'),
                'modified_at' => date('Y-m-d H:i:s')
            ];

            $try = $this->MilestoneModel->update($data);
            
            $msg = $try ? 'Edit Successfully' : 'Error: '. $this->MilestoneModel->getError();
            
            $this->session->set('flashMsg', $msg);
            return $this->app->redirect(
                $this->router->url('milestones')
            );
        }
    }

    public function delete()
    {
        $ids = $this->validateID();

        $count = 0;
        if (is_array($ids)) {
            foreach ($ids as $id) {
                //Delete file in source
                if ($this->MilestoneModel->remove($id)) {
                    $count++;
                }
            }
        } elseif (is_numeric($ids)) {
            if ($this->MilestoneModel->remove($ids)) {
                $count++;
            }
        }


        $this->session->set('flashMsg', $count . ' deleted record(s)');
        return $this->app->redirect(
            $this->router->url('milestones'),
        );
    }

    public function validateID()
    {
        
        $urlVars = $this->request->get('urlVars');
        $id = $urlVars ? (int) $urlVars['id'] : 0;

        if (empty($id)) {
            $ids = $this->request->post->get('ids', [], 'array');
            if (count($ids)) return $ids;

            $this->session->set('flashMsg', 'Invalid Milestone');
            return $this->app->redirect(
                $this->router->url('milestones'),
            );
        }

        return $id;
    }
}
